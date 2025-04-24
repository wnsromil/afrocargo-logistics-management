<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Parcel,
    ParcelHistory,
    Invoice,
    ParcelInventorie
};
use Carbon\Carbon;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Validation\Rule;


class OrderShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parcels = Parcel::where('parcel_type', $request->parcel_type)->select('id', 'tracking_number', 'driver_id', 'warehouse_id', 'customer_id')->when($this->user->role_id != 1, function ($q) {
            // return $q->where('warehouse_id', $this->user->warehouse_id);
        })->when($this->user->role_id == 3, function ($q) {
            return $q->where('customer_id', $this->user->id);
        })->when($this->user->role_id == 4, function ($q) {
            return $q->where('driver_id', $this->user->id);
        })
            ->when(!empty($request->status), function ($q) use ($request) {
                return $q->whereIn('status', explode(',', $request->status));
            })
            ->when(!empty($request->order_type), function ($q) use ($request) {
                $today = now()->format('Y-m-d'); // Aaj ki date

                if ($request->order_type == 'Pending') {

                    return $q->whereDate('created_at', '<', $today); // Aaj se pehle ki date ka data
                } elseif ($request->order_type == 'today') {
                    return $q->whereDate('created_at', '=', $today); // Aaj ki date ka data
                } elseif ($request->order_type == 'upcoming') {
                    return $q->whereDate('created_at', '>=', $today); // Aaj aur aage ki date ka data
                } elseif ($request->order_type == 'Received By Pickup Man') {
                    return $q->where('status', 'Received By Pickup Man'); // Sirf complete status wale records
                }
            })
            ->with(['warehouse', 'customer', 'driver'])
            ->latest('id')
            ->paginate(10);

        return $this->sendResponse($parcels, 'Parcel data fetched successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'weight' => 'required|numeric|min:0',
                'total_amount' => 'required|numeric|min:0',
                'estimate_cost' => 'required|numeric|min:0',
                'partial_payment' => 'required|numeric|min:0',
                'remaining_payment' => 'required|numeric|min:0',
                'payment_type' => 'required|in:COD,Online',
                'descriptions' => 'nullable|string',
                'destination_address' => 'required|string|max:255',
                'destination_user_name' => 'required|string|max:255',
                'destination_user_phone' => 'required|digits:10',
                'parcel_card_ids' => 'nullable|array',
                'customer_subcategories_data' => 'nullable', // JSON format required
                'driver_subcategories_data' => 'nullable',   // JSON format required
                'pickup_address_id' => 'required|numeric',
                'delivery_address_id' => 'required|numeric',
                'pickup_time' => 'required|string',
                'pickup_date' => 'required|date',
                'source_address' => 'required',
            ]);

            // Remaining Payment Check
            if ($request->remaining_payment > 0) {
                $validatedData['payment_status'] = 'Partial';
            }

            // Assign customer ID
            $validatedData['customer_id'] = $this->user->id;

            // Convert parcel_card_ids to parcel_car_ids
            // $validatedData['parcel_car_ids'] = $validatedData['parcel_card_ids'];
            // unset($validatedData['parcel_card_ids']);

            // **JSON Encode Arrays Properly**
            if (!empty($request->customer_subcategories_data)) {
                // Ensure it's an array before encoding
                $customerData = is_string($request->customer_subcategories_data) ? json_decode($request->customer_subcategories_data, true) : $request->customer_subcategories_data;
                $validatedData['customer_subcategories_data'] = json_encode($customerData, JSON_UNESCAPED_UNICODE);
            }

            if (!empty($request->driver_subcategories_data)) {
                // Ensure it's an array before encoding
                $driverData = is_string($request->driver_subcategories_data) ? json_decode($request->driver_subcategories_data, true) : $request->driver_subcategories_data;
                $validatedData['driver_subcategories_data'] = json_encode($driverData, JSON_UNESCAPED_UNICODE);
            }

            // Create Parcel
            $Parcel = Parcel::create($validatedData);

            // Create Parcel History
            ParcelHistory::create([
                'parcel_id' => $Parcel->id,
                'created_user_id' => $this->user->id,
                'customer_id' => $validatedData['customer_id'],
                'status' => 'Created',
                'parcel_status' => 'Pending',
                'description' => json_encode($validatedData, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            return $this->sendResponse($Parcel, 'Order added successfully.');
        } catch (Exception $e) {
            // Log the error
            Log::error('Parcel Store Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the parcel.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $parcel = Parcel::where('id', $id)
            ->with(['warehouse', 'customer', 'driver', 'pickupaddress', 'deliveryaddress'])
            ->first();

        if (!$parcel) {
            return $this->sendError('Parcel not found!', [], 404);
        }

        // Format pickup_date
        $formattedPickupDate = $parcel->pickup_date
            ? Carbon::parse($parcel->pickup_date)->format('m-d-Y')
            : null;

        // Parcel data ko array me convert karke pickup_date replace karein
        $parcelData = $parcel->toArray();
        $parcelData['pickup_date'] = $formattedPickupDate;

        return $this->sendResponse($parcelData, 'Order data fetched successfully.');
    }


    public function OrderHistory(string $id)
    {
        //
        $parcel = Parcel::where('id', $id)->orWhere('tracking_number', $id)->first();
        $ParcelHistories = ParcelHistory::where('parcel_id', $parcel->id)
            ->with(['warehouse', 'customer', 'createdByUser'])->paginate(10);

        return $this->sendResponse($ParcelHistories, 'Order histories fetch  successfully.');
    }

    public function OrderShipmentStatus(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:parcels,id',
            'status' => 'required|in:Pending,Pickup Assign,Pickup Re-Schedule,Received By Pickup Man,Received Warehouse,Transfer to hub,Received by hub,Delivery Man Assign,Return to Courier,Delivered,Cancelled',
        ]);

        $parcel = Parcel::where('id', $validatedData['order_id'])
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })->when($this->user->role_id == 3, function ($q) {
                return $q->where('customer_id', $this->user->id);
            })->when($this->user->role_id == 4, function ($q) {
                return $q->where('driver_id', $this->user->id);
            })
            ->first();

        if (empty($parcel)) {
            return $this->sendError('Data not fund.', ['error' => 'Data not fund.']);
        }

        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'warehouse_id' => $parcel->warehouse_id ?? null,
            'status' => 'Updated',
            'parcel_status' => $validatedData['status'],
            'description' => collect($parcel)
        ]);

        $parcel->status = $validatedData['status'];
        $parcel->save();

        return $this->sendResponse($parcel, 'Order status updated successfully.');
    }

    public function inventoryOrderCategories()
    {
        $categories = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        return $this->sendResponse($categories, 'Order  categories fetch successfully.');
    }

    public function getParcelDetailsById($id)
    {
        // Parcel find karein sirf required fields ke saath
        $parcel = Parcel::select(
            'customer_subcategories_data',
            'driver_subcategories_data',
            'destination_address',
            'destination_user_phone',
            'destination_user_name',
            'id'
        )->find($id);

        if (!$parcel) {
            return response()->json([
                'success' => false,
                'message' => 'Parcel not found!'
            ], 404);
        }

        // Customer & Driver JSON data ko check karein ki already array hai ya nahi
        $customerData = is_array($parcel->customer_subcategories_data)
            ? $parcel->customer_subcategories_data
            : json_decode($parcel->customer_subcategories_data, true);

        $driverData = is_array($parcel->driver_subcategories_data)
            ? $parcel->driver_subcategories_data
            : json_decode($parcel->driver_subcategories_data, true);

        // ✅ Customer subcategories ke category_id ke liye category_name fetch karein
        if (is_array($customerData)) {
            foreach ($customerData as &$category) {
                $category['category_name'] = Category::where('id', $category['category_id'])->value('name');
            }
        }

        // ✅ Driver subcategories ke category_id ke liye category_name fetch karein
        if (is_array($driverData)) {
            foreach ($driverData as &$category) {
                $category['category_name'] = Category::where('id', $category['category_id'])->value('name');
            }
        }

        // ✅ Final Response
        return response()->json([
            'success' => true,
            'data' => [
                'driver_subcategories_data' => $driverData,
                'destination_address' => $parcel->destination_address,
                'destination_user_phone' => $parcel->destination_user_phone,
                'destination_user_name' => $parcel->destination_user_name,
                'parcels_id' => $parcel->id,
                'estimated_value' => $parcel->total_amount,
                'length' => $parcel->length,
                'width' => $parcel->width,
                'height' => $parcel->height,
                'weight' => $parcel->weight,
            ]
        ]);
    }

    public function updateDriverParcel(Request $request)
    {
        $request->validate([
            'parcels_id' => 'required|integer',
            'driver_subcategories_data' => 'required',
            'payment_type' => 'required|string',
            'driver_parcel_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estimated_value' => 'required|integer',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        // Form-data se aane wale JSON ko array mein convert kar rahe hain
        if (is_string($request->driver_subcategories_data)) {
            $request->driver_subcategories_data = json_decode($request->driver_subcategories_data, true);
        }

        if (!is_array($request->driver_subcategories_data)) {
            return response()->json(['message' => 'The driver subcategories data field must be a valid JSON array.'], 422);
        }

        // Parcel ko find kar rahe hain
        $parcel = Parcel::find($request->parcels_id);

        if (!$parcel) {
            return response()->json(['message' => 'Parcel not found'], 404);
        }

        // JSON encode karke driver_subcategories_data ko update karenge
        $parcel->driver_subcategories_data = json_encode($request->driver_subcategories_data);

        // Payment type ko update karenge
        $parcel->payment_type = $request->payment_type;
        $parcel->total_amount = $request->estimated_value;
        $parcel->length = $request->length;
        $parcel->width = $request->width;
        $parcel->height = $request->height;
        $parcel->weight = $request->weight;
        $parcel->update_role = 'driver';
        if ($request->payment_mode == "partial_payment") {
            $parcel->partial_payment = $request->paying_amount;
            $parcel->remaining_payment = $request->remaining_amount;
        } else {
            $parcel->partial_payment = 0;
            $parcel->remaining_payment = 0;
        }

        // Image upload aur path store
        if ($request->hasFile('driver_parcel_image')) {
            $image = $request->file('driver_parcel_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/driver_parcel'), $imageName);
            $parcel->driver_parcel_image = 'uploads/driver_parcel/' . $imageName;
        }

        // Save kar rahe hain
        $parcel->save();

        return response()->json(['message' => 'Parcel updated successfully', 'parcel' => $parcel]);
    }

    public function driverCreateOrder(Request $request)
    {
        if (!$request->has('customer_id') || empty($request->customer_id)) {
            $customerController = new CustomerController();
            $customer = $customerController->createCustomer($request);
            if ($customer instanceof \Illuminate\Http\JsonResponse) {
                return $customer; // Return validation errors if any
            }
            $request->merge(['user_id' => $customer->id]);
            $addressController = new AddressController();
            $addressRequest = new Request($request->only(['user_id', 'mobile_number', 'alternative_mobile_number', 'address', 'pincode', 'country_id', 'state_id', 'city_id', 'address_type']));
            $address = $addressController->createAddress($addressRequest);
            $request->merge(['pickup_id' => $address->id]);
        }

        if (!$request->has('delivery_id') || empty($request->delivery_id)) {
            $addressController = new AddressController();
            $addressRequest = new Request($request->only(['user_id', 'mobile_number', 'alternative_mobile_number', 'address', 'pincode', 'country_id', 'state_id', 'city_id', 'address_type']));
            $address = $addressController->createAddress($addressRequest);
            $request->merge(['delivery_id' => $address->id]);
        }

        return response()->json(['message' => 'Order creation process completed', 'customer_id' => $request->customer_id, 'ship_to' => $request->ship_to], 200);
    }

    public function estimatPrice(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:0',
            'distance' => 'required|numeric|min:0',
            'amount' => 'nullable|numeric|min:0'
        ]);

        $weight_rate = setting()->get('weight_rate');
        $weight_unit = setting()->get('weight_unit');
        $distance_rate = setting()->get('distance_rate');
        $distance_unit = setting()->get('distance_unit');

        $data = calculatePrice($request->input('weight', 0), $weight_unit, $weight_rate) +
            calculatePrice($request->input('distance', 0), $distance_unit, $distance_rate);

        return $this->sendResponse($data, 'Estimate Price fetched successfully.');
    }
    public function invoiceOrderCreateService(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'customer_id' => 'required',
                'ship_customer_id' => 'required',
                'container_id' => 'required',
                'customer_subcategories_data' => 'nullable', // JSON format required
                'driver_subcategories_data' => 'nullable',   // JSON format required
                'total_amount' => 'required|numeric|min:0',
                'parcel_card_ids' => 'required|array',
                'payment_type' => 'required|in:COD,Online,Cash',
                'status' => 'required|in:Pending',
                'pickup_time' => 'required|string',
                'pickup_date' => 'required|date',
            ]);

            // Assign customer ID
            $validatedData['driver_id'] = $this->user->id;
            $validatedData['parcel_type'] = 'Service';
            $validatedData['add_order'] = 'driver';
            $validatedData['estimate_cost'] = $request->estimate_cost ?? null;
            // Convert parcel_card_ids to parcel_car_ids
            $validatedData['parcel_car_ids'] = $validatedData['parcel_card_ids'];
            unset($validatedData['parcel_card_ids']);

            // **JSON Encode Arrays Properly**
            if (!empty($request->customer_subcategories_data)) {
                // Ensure it's an array before encoding
                $customerData = is_string($request->customer_subcategories_data) ? json_decode($request->customer_subcategories_data, true) : $request->customer_subcategories_data;
                $validatedData['customer_subcategories_data'] = json_encode($customerData, JSON_UNESCAPED_UNICODE);
            }

            if (!empty($request->driver_subcategories_data)) {
                // Ensure it's an array before encoding
                $driverData = is_string($request->driver_subcategories_data) ? json_decode($request->driver_subcategories_data, true) : $request->driver_subcategories_data;
                $validatedData['driver_subcategories_data'] = json_encode($driverData, JSON_UNESCAPED_UNICODE);
            }

            // Create Parcel
            $Parcel = Parcel::create($validatedData);

            // Create Parcel History
            ParcelHistory::create([
                'parcel_id' => $Parcel->id,
                'created_user_id' => $this->user->id,
                'customer_id' => $validatedData['customer_id'],
                'status' => 'Created',
                'parcel_status' => 'Pending',
                'description' => json_encode($validatedData, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            Invoice::create([
                'generated_by' => 'driver',
                'generated_status' => 'view_only',
                'issue_date' => now()->format('Y-m-d'),
                'parcel_id' => $Parcel->id,
                'user_id' => $this->user->id,
                'total_amount' => $request->total_amount,
                'is_paid' => $request->payment_status === 'Paid' ? 1 : 0,
                'invoice_no' => 'INV-' . rand(1000000, 9999999),
            ]);

            return $this->sendResponse($Parcel, 'Order added successfully.');
        } catch (Exception $e) {
            // Log the error
            Log::error('Parcel Store Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the parcel.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function invoiceOrderCreateSupply(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'customer_id' => 'required',
                'customer_subcategories_data' => 'nullable', // JSON format required
                'driver_subcategories_data' => 'nullable',   // JSON format required
                'total_amount' => 'required|numeric|min:0',
                'parcel_card_ids' => 'required|array',
                'payment_type' => 'required|in:COD,Online,Cash',
                'status' => 'required|in:Pending',
            ]);

            // Assign customer ID
            $validatedData['driver_id'] = $this->user->id;
            $validatedData['parcel_type'] = 'Supply';
            $validatedData['add_order'] = 'driver';
            $validatedData['estimate_cost'] = $request->estimate_cost ?? null;
            // Convert parcel_card_ids to parcel_car_ids
            $validatedData['parcel_car_ids'] = $validatedData['parcel_card_ids'];
            unset($validatedData['parcel_card_ids']);

            // **JSON Encode Arrays Properly**
            if (!empty($request->customer_subcategories_data)) {
                // Ensure it's an array before encoding
                $customerData = is_string($request->customer_subcategories_data) ? json_decode($request->customer_subcategories_data, true) : $request->customer_subcategories_data;
                $validatedData['customer_subcategories_data'] = json_encode($customerData, JSON_UNESCAPED_UNICODE);
            }

            if (!empty($request->driver_subcategories_data)) {
                // Ensure it's an array before encoding
                $driverData = is_string($request->driver_subcategories_data) ? json_decode($request->driver_subcategories_data, true) : $request->driver_subcategories_data;
                $validatedData['driver_subcategories_data'] = json_encode($driverData, JSON_UNESCAPED_UNICODE);
            }

            // Create Parcel
            $Parcel = Parcel::create($validatedData);

            // Create Parcel History
            ParcelHistory::create([
                'parcel_id' => $Parcel->id,
                'created_user_id' => $this->user->id,
                'customer_id' => $validatedData['customer_id'],
                'status' => 'Created',
                'parcel_status' => 'Pending',
                'description' => json_encode($validatedData, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            Invoice::create([
                'generated_by' => 'driver',
                'generated_status' => 'view_only',
                'issue_date' => now()->format('Y-m-d'),
                'parcel_id' => $Parcel->id,
                'user_id' => $this->user->id,
                'total_amount' => $request->total_amount,
                'is_paid' => $request->payment_status === 'Paid' ? 1 : 0,
                'invoice_no' => 'INV-' . rand(1000000, 9999999),
            ]);

            return $this->sendResponse($Parcel, 'Order added successfully.');
        } catch (Exception $e) {
            // Log the error
            Log::error('Parcel Store Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the parcel.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeSupply(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'delivery_address_id' => 'required|numeric',
                'inventorie_data' => 'required|array', // Ensure inventorie_data is an array
                'inventorie_data.*.inventorie_id' => [
                    'required',
                    'numeric',
                    Rule::exists('inventories', 'id'), // Ensure each inventorie_id exists in the inventories table
                ],
                'inventorie_data.*.inventorie_item_quantity' => 'required|numeric|min:0', // Validate quantity
                'total_amount' => 'required|numeric|min:0',
                'partial_payment' => 'required|numeric|min:0',
                'remaining_payment' => 'required|numeric|min:0',
                'payment_type' => 'required|in:COD,Online',
            ]);

            // Remaining Payment Check
            if ($request->remaining_payment > 0) {
                $validatedData['payment_status'] = 'Partial';
            }

            // Assign customer ID
            $validatedData['customer_id'] = $this->user->id;
            $validatedData['parcel_type'] = 'Supply';

            // Remove unnecessary fields
            unset($validatedData['inventorie_data']);

            // Create Parcel
            $parcel = Parcel::create($validatedData);

            // Store Parcel Inventories
            foreach ($request->inventorie_data as $item) {
                ParcelInventorie::create([
                    'parcel_id' => $parcel->id,
                    'inventorie_id' => $item['inventorie_id'],
                    'inventorie_item_quantity' => $item['inventorie_item_quantity'],
                ]);
            }

            // Create Parcel History
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => $this->user->id,
                'customer_id' => $validatedData['customer_id'],
                'status' => 'Created',
                'parcel_status' => 'Pending',
                'description' => json_encode($validatedData, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            return $this->sendResponse($parcel, 'Order added successfully.');
        } catch (Exception $e) {
            // Log the error
            Log::error('Parcel Store Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the parcel.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // end
}
