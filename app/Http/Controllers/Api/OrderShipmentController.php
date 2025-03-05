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
    ParcelHistory
};
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CustomerController;

class OrderShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parcels = Parcel::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
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

                if ($request->order_type == 'pending') {
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
            ->latest()
            ->paginate(10);

        return $this->sendResponse($parcels, 'Parcel data fetched successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'weight' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'partial_payment' => 'required|numeric|min:0',
            'remaining_payment' => 'required|numeric|min:0',
            'payment_type' => 'required|in:COD,Online',
            'descriptions' => 'nullable|string',
            'source_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'destination_user_name' => 'required|string|max:255',
            'destination_user_phone' => 'required|numeric|min:10',
            'parcel_card_ids' => 'required|array',
            'source_let' => 'required|numeric|min:0',
            'source_long' => 'required|numeric|min:0',
            'dest_let' => 'nullable|numeric|min:0',
            'dest_long' => 'nullable|numeric|min:0',
            'customer_subcategories_data' => 'nullable|array', // ✅ JSON object accept karega
            'driver_subcategories_data' => 'nullable|array',   // ✅ JSON object accept karega
        ]);

        if ($request->remaining_payment && $request->remaining_payment > 0) {
            $validatedData['payment_status'] = 'Partial';
        }

        $validatedData['customer_id'] = $this->user->id;
        $validatedData['parcel_car_ids'] = $validatedData['parcel_card_ids'];
        unset($validatedData['parcel_card_ids']);

        // ✅ Ensure `customer_subcategories_data` is stored in correct JSON format
        $validatedData['customer_subcategories_data'] = $request->has('customer_subcategories_data')
            ? json_encode([
                "category_id" => $request->customer_subcategories_data['category_id'] ?? null,
                "subcategories" => $request->customer_subcategories_data['subcategories'] ?? []
            ])
            : null;

        // ✅ Ensure `driver_subcategories_data` is stored in correct JSON format
        $validatedData['driver_subcategories_data'] = $request->has('driver_subcategories_data')
            ? json_encode([
                "category_id" => $request->driver_subcategories_data['category_id'] ?? null,
                "subcategories" => $request->driver_subcategories_data['subcategories'] ?? []
            ])
            : null;

        $Parcel = Parcel::create($validatedData);

        ParcelHistory::create([
            'parcel_id' => $Parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $validatedData['customer_id'],
            'status' => 'Created',
            'parcel_status' => 'Pending',
            'description' => collect($validatedData),
        ]);

        return $this->sendResponse($Parcel, 'Order added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ParcelHistories = Parcel::where('id', $id)
            ->with(['warehouse', 'customer', 'driver'])->first();

        return $this->sendResponse($ParcelHistories, 'Order data fetch  successfully.');
    }

    public function OrderHistory(string $id)
    {
        //
        $ParcelHistories = ParcelHistory::where('parcel_id', $id)
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

}
