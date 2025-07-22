<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Vehicle;
use App\Models\Parcel;
use App\Models\ShippingUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistorMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function getCustomersInvoice(Request $request)
    {
        $request->validate([
            'invoice_custmore_type' => 'nullable|in:from_to,ship_to,all',
            'invoice_custmore_id' => 'required|integer',
            'search' => 'nullable|string|max:255',
        ]);

        $type = $request->query('invoice_custmore_type');
        $invoiceCustomerId = $request->query(key: 'invoice_custmore_id');

        $query = User::whereIn('role_id', [3,5])->orderBy('id', 'desc');
        $query->where('invoice_custmore_id', $invoiceCustomerId);
        $query->orWhere('parent_customer_id', $invoiceCustomerId);
        if ($request->has('search') && !empty($request->query('search'))) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        $customers = $query->orderBy(column: 'name')->get(['id', 'address', 'name', 'phone', 'phone_2', 'email', 'profile_pic', 'signature_img', 'contract_signature_img', 'license_document']);

        foreach ($customers as $customer) {
            $address = Address::where('user_id', $customer->id)->with(['country', 'state', 'city'])->first();
            if ($address && !empty($address->address)) {
                $customer->address = $address->address;
            } else {
                $customer->address = $customer->address ?? null;
            }
        }



        return response()->json(['customers' => $customers], 200);
    }

    public function getCustomersDriver(Request $request)
    {
        $request->validate([
            'created_by_id' => 'required|integer',
            'search' => 'nullable|string|max:255',
        ]);

        $DriverCustomerId = $request->query(key: 'created_by_id');

        $query = User::where('role_id', operator: 3)->orderBy('id', 'desc');
        $query->where('created_by_id', $DriverCustomerId);
        $query->where('invoice_custmore_type', 'from_to'); // Assuming you want to filter by 'from_to' type
        // $query->where('invoice_custmore_id', null);

        if ($request->has('search') && !empty($request->query('search'))) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        $customers = $query->orderBy(column: 'name')->get();

        foreach ($customers as $customer) {
            $address = Address::where('user_id', $customer->id)->with(['country', 'state', 'city'])->first();
            if ($address && !empty($address->address)) {
                $customer->address = $address->address;
            } else {
                $customer->address = $customer->address ?? null;
            }
        }


        return response()->json(['customers' => $customers], 200);
    }

    public function getCustomers(Request $request)
    {
        $request->validate([
            'invoice_custmore_type' => 'nullable|in:from_to,ship_to,all',
            'invoice_custmore_id' => 'nullable|integer',
            'search' => 'nullable|string|max:255',
        ]);

        $type = $request->query('invoice_custmore_type');
        $invoiceCustomerId = $request->query('invoice_custmore_id');

        $query = User::where('role', 'customer')->orderBy('id', 'desc');


        if ($invoiceCustomerId) {
            // Only fetch this specific customer by ID
            $query->where('invoice_custmore_id', $invoiceCustomerId);
        } else {
            // Apply type filter only if invoice_custmore_id not provided
            if ($type && in_array($type, ['from_to', 'ship_to'])) {
                $query->where('invoice_custmore_type', $type);
            }
        }

        if ($request->has('search') && !empty($request->query('search'))) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        $customers = $query->orderBy(column: 'name')->get(['id', 'address', 'name', 'phone', 'phone_2', 'email', 'profile_pic', 'signature_img', 'contract_signature_img', 'license_document']);

        foreach ($customers as $customer) {
            $address = Address::where('user_id', $customer->id)->with(['country', 'state', 'city'])->first();
            if ($address && !empty($address->address)) {
                $customer->address = $address->address;
            } else {
                $customer->address = $customer->address ?? null;
            }
        }

        return response()->json(['customers' => $customers], 200);
    }

    public function getCustomersDetails(Request $request)
    {
        $id = $request->id;

        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }

        // Step 1: Main customer record by ID
        $customer = User::whereIn('role_id', [5,3])
            ->where('id', $id)
            ->with('vehicle', 'invoiceCustmore')
            ->first();

        if (!$customer) {
            return response()->json(['message' => 'No customer found'], 404);
        }

        // Step 2: Latest related user where invoice_custmore_id == $id
        $latestRelated = User::where('invoice_custmore_id', $id)
            ->orderByDesc('id') // ya ->latest() agar created_at use kar rahe ho
            ->first();

        return response()->json([
            'customer' => $customer,
            'latest_related' => $latestRelated,
        ], 200);
    }


    public function createCustomer(Request $request)
    {

        $validated =  $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_code' => 'required|max:13|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'alternate_mobile_no' => 'nullable|max:13',
            'address' => 'required|string|max:255',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'Zip_code' => 'required|string|max:10',
            'username' => 'required|string|max:255|unique:users,username',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'country_code' => 'required',
            'invoice_custmore_type' => 'required|in:from_to,ship_to',
            'invoice_custmore_id' => 'nullable|integer',
        ]);

        try {
            $imagePaths = [];
            foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType) {
                if ($request->hasFile($imageType)) {
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();

                    $folder = ($imageType === 'profile_pics') ? 'uploads/profile_pics' : 'uploads/customer';
                    $filePath = $file->storeAs($folder, $fileName, 'public');

                    $imagePaths[$imageType] = $filePath;
                }
            }

            $user = $this->user;

            $randomPassword = Str::random(8); // Random password of 8 characters
            $hashedPassword = Hash::make($randomPassword); // Hashing password

            $role = 'customer';
            $role_id = 3;

            if ($validated['invoice_custmore_type'] === 'ship_to') {
                $role = 'ship_to_customer';
                $role_id = 5;
            }


            $userData = [
                'name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['mobile_code'],
                'phone_2' => $validated['alternate_mobile_no'] ?? null,
                'address' => $validated['address'],
                'address_2' => $request->address_2,
                'country_id' => $validated['country'],
                'state_id' => $validated['state'],
                'role' => $role,                      // ✅ Dynamic role
                'role_id' => $role_id,                // ✅ Dynamic role_id
                'created_by_id' => $user->id,
                'city_id' => $validated['city'],
                'pincode' => $validated['Zip_code'],
                'password' => $hashedPassword,
                'status' => $request->status ?? 'Active',
                'company_name' => $request->company_name ?? null,
                'apartment' => $request->apartment ?? null,
                'username' => $validated['username'],
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
                'website_url' => $request->website_url ?? null,
                'write_comment' => $request->write_comment ?? null,
                'read_comment' => $request->read_comment ?? null,
                'language' => $request->language ?? null,
                'year_to_date' => $request->year_to_date ?? null,
                'license_number' => $request->license_number ?? null,
                'warehouse_id' => $request->warehouse_id ?? null,
                'signature_img' => $imagePaths['signature'] ?? null,
                'contract_signature_img' => $imagePaths['contract_signature'] ?? null,
                'license_document' => $imagePaths['license_picture'] ?? null,
                'profile_pic' => $imagePaths['profile_pics'] ?? null,
                'signup_type' => 'for_driver',
                'country_code' => $request->country_code ?? null,
                'country_code_2' => $request->country_code_2 ?? null,
                'invoice_custmore_type' => $request->invoice_custmore_type,
                'invoice_custmore_id' => $request->invoice_custmore_id ?? null,
                //'invoice_custmore_id' => null,
                'vehicle_id'        => $request->container_id ?? null,
            ];

            if (!empty($request->license_expiry_date)) {
                $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
            }

            if (!empty($request->signature_date)) {
                $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
            }

            $userName = $request->first_name;
            $email = $request->email ?? null;
            $mobileNumber = $request->mobile_code;
            $password = $randomPassword;
            $loginUrl = route('login');

            // Send the email
            Mail::to($email)->send(new RegistorMail($userName, $email, $mobileNumber, $password, $loginUrl));

            $user = User::create($userData);

            insertAddress([
                'user_id' => $user->id,
                'address' => $validated['address'],
                'address_type' => 'pickup',
                'mobile_number' => $validated['mobile_code'] ?? null,
                'alternative_mobile_number' => $validated['alternate_mobile_no'] ?? null,
                'mobile_number_code_id'        =>  $request->country_code ?? null,
                'alternative_mobile_number_code_id' => $request->country_code_2 ?? null,
                'city_id' => $validated['city'] ?? null,
                'country_id' => $validated['country'] ?? null,
                'full_name' => $validated['first_name'],
                'pincode' => $validated['Zip_code'] ?? null,
                'state_id' => $validated['state'] ?? null,
                'warehouse_id' => $request->warehouse_id ?? null,
                'lat' => $validated['latitude'] ?? null,
                'long' => $validated['longitude'] ?? null,
                'type' => 'Services', // Default type
                'default_address' => 'Yes'
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                // 'trace' => $e->getTraceAsString() // optional
            ], 500);
        }
    }

    public function createShippingCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone',
            'phone_2' => 'nullable|string|max:255',
            'country_id' => 'required|string|max:15',
            // 'state_id' => 'required|string|max:255',
            // 'city_id' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'ship_to_id' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'lookup_name' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'municipal' => 'nullable|string|max:255',
            'sector' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if user exists based on phone or phone_2
        $existingUser = User::where('phone', $request->phone)
            ->orWhere('phone_2', $request->phone)
            ->first();

        if (!$existingUser) {

            // Call createCustomer if user does not exist
            $newUser = $this->createCustomer($request->all());
            $customer_id = $newUser->id;
        } else {
            $customer_id = $existingUser->id;
        }



        // Example dynamic data
        $userName = $request->first_name;
        $email = $request->email ?? null;
        $mobileNumber = $request->phone;
        $password = '12345678';
        $loginUrl = route('login');

        // Send the email
        Mail::to($email)->send(new RegistorMail($userName, $email, $mobileNumber, $password, $loginUrl));

        // Create new ShippingUser entry
        $shippingUser = new ShippingUser();
        $shippingUser->shipping_user_id = $customer_id;
        $shippingUser->customer_id = $customer_id;
        $shippingUser->created_id = $this->user->id;
        $shippingUser->country_id = $request->country_id;
        $shippingUser->address_1 = $request->address_1;
        $shippingUser->address_2 = $request->address_2;
        $shippingUser->ship_to_id = $request->ship_to_id ?? 'Done';
        $shippingUser->company_name = $request->company_name;
        $shippingUser->apartment = $request->apartment;
        $shippingUser->latitude = $request->latitude;
        $shippingUser->longitude = $request->longitude;
        $shippingUser->lookup_name = $request->lookup_name;
        $shippingUser->province = $request->province;
        $shippingUser->municipal = $request->municipal;
        $shippingUser->sector = $request->sector;
        $shippingUser->language = $request->language;
        $shippingUser->save();

        return response()->json(['shipping_user' => $shippingUser], 200);
    }

    public function shippingCustomerList($id)
    {
        $customers = ShippingUser::where('user_id', $id)->get();

        if ($customers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No shipping records found for this customer.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipping customer details retrieved successfully.',
            'data' => $customers
        ], 200);
    }

    public function deleteCustomer(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->update(['is_deleted' => "Yes"]); // is_deleted ko "Yes" update kar rahe hain

        return response()->json([
            'success' => true,
            'message' => 'User marked as deleted successfully',
            'user' => $user
        ], 200);
    }

    public function getUsersByWarehouse(Request $request)
    {
        $warehouseId = $request->warehouse_id;
        $role = $request->role_id;

        if (!$warehouseId) {
            return response()->json(['message' => 'Warehouse ID is required'], 400);
        }

        // Step 1: Get user IDs from given warehouse
        $userIdsFromWarehouse = User::where('warehouse_id', $warehouseId)->pluck('id');

        // Step 2: Filter those users with conditions
        $users = User::whereIn('id', $userIdsFromWarehouse)
            ->where('status', 'Active')
            ->whereIn('role_id', [2, 4])
            ->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found for the given warehouse.'], 404);
        }

        return response()->json(['users' => $users->when(!empty($role), function ($q) {
            return $q->where('role_id', request()->role_id);
        })->values()], 200);
    }

    public function getVehiclesByWarehouse(Request $request)
    {
        $warehouseId = $request->warehouse_id;

        if (!$warehouseId) {
            return response()->json(['message' => 'Warehouse ID is required'], 400);
        }

        // Step 1: Get vehicles based on warehouse_id
        $vehicles = Vehicle::where('vehicle_type', '1')->where('warehouse_id', $warehouseId)->get();

        if ($vehicles->isEmpty()) {
            return response()->json(['message' => 'No vehicles found for the given warehouse.'], 404);
        }

        return response()->json(['vehicles' => $vehicles], 200);
    }

    public function updateCustomer(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'mobile_no' => 'sometimes|max:13|unique:users,phone,' . $request->customer_id,
            'email' => 'sometimes|email|max:255|unique:users,email,' . $request->customer_id,
            'alternate_mobile_no' => 'sometimes|nullable|max:13',
            'address' => 'sometimes|string|max:255',
            'country' => 'sometimes|string',
            'state' => 'sometimes|string',
            'city' => 'sometimes|string',
            'Zip_code' => 'sometimes|string|max:10',
            'username' => 'sometimes|string|max:255|unique:users,username,' . $request->customer_id,
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'country_code' => 'sometimes',
            'invoice_custmore_type' => 'sometimes|in:from_to,ship_to',
            'invoice_custmore_id' => 'sometimes|nullable|integer',
        ]);

        try {
            $imagePaths = [];
            foreach (['profile_pics', 'signature', 'contract_signature', 'license_picture'] as $imageType) {
                if ($request->hasFile($imageType)) {
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();

                    $folder = ($imageType === 'profile_pics') ? 'uploads/profile_pics' : 'uploads/customer';
                    $filePath = $file->storeAs($folder, $fileName, 'public');

                    if ($imageType === 'license_picture') {
                        $filePath =  $filePath;
                    }

                    $imagePaths[$imageType] = $filePath;
                }
            }

            $userData = [];
            if (isset($validated['last_name'])) $userData['name'] = $validated['last_name'];
            if (isset($validated['last_name'])) $userData['last_name'] = $validated['last_name'];
            if (isset($validated['email'])) $userData['email'] = $validated['email'];
            if (isset($validated['mobile_no'])) $userData['phone'] = $validated['mobile_no'];
            if (array_key_exists('alternate_mobile_no', $validated)) $userData['phone_2'] = $validated['alternate_mobile_no'];
            if (isset($validated['address'])) $userData['address'] = $validated['address'];
            if ($request->has('address_2')) $userData['address_2'] = $request->address_2;
            if (isset($validated['country'])) $userData['country_id'] = $validated['country'];
            if (isset($validated['state'])) $userData['state_id'] = $validated['state'];
            if (isset($validated['city'])) $userData['city_id'] = $validated['city'];
            if (isset($validated['Zip_code'])) $userData['pincode'] = $validated['Zip_code'];
            if (isset($validated['username'])) $userData['username'] = $validated['username'];
            if (isset($validated['latitude'])) $userData['latitude'] = $validated['latitude'];
            if (isset($validated['longitude'])) $userData['longitude'] = $validated['longitude'];
            if ($request->has('status')) $userData['status'] = $request->status;
            if ($request->has('company_name')) $userData['company_name'] = $request->company_name;
            if ($request->has('apartment')) $userData['apartment'] = $request->apartment;
            if ($request->has('website_url')) $userData['website_url'] = $request->website_url;
            if ($request->has('write_comment')) $userData['write_comment'] = $request->write_comment;
            if ($request->has('read_comment')) $userData['read_comment'] = $request->read_comment;
            if ($request->has('language')) $userData['language'] = $request->language;
            if ($request->has('year_to_date')) $userData['year_to_date'] = $request->year_to_date;
            if ($request->has('license_number')) $userData['license_number'] = $request->license_number;
            if ($request->has('warehouse_id')) $userData['warehouse_id'] = $request->warehouse_id;
            if ($request->has('country_code')) $userData['country_code'] = $request->country_code;
            if ($request->has('country_code_2')) $userData['country_code_2'] = $request->country_code_2;
            if (isset($validated['invoice_custmore_type'])) $userData['invoice_custmore_type'] = $validated['invoice_custmore_type'];
            if (isset($validated['invoice_custmore_id'])) $userData['invoice_custmore_id'] = $validated['invoice_custmore_id'];
            if ($request->has('container_id')) $userData['vehicle_id'] = $request->container_id;

            // Images
            if (!empty($imagePaths['signature'])) $userData['signature_img'] = $imagePaths['signature'];
            if (!empty($imagePaths['contract_signature'])) $userData['contract_signature_img'] = $imagePaths['contract_signature'];
            if (!empty($imagePaths['license_picture'])) $userData['license_document'] = $imagePaths['license_picture'];
            if (!empty($imagePaths['profile_pics'])) $userData['profile_pic'] = $imagePaths['profile_pics'];

            // Dates
            if (!empty($request->license_expiry_date)) {
                $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
            }
            if (!empty($request->signature_date)) {
                $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
            }

            // Only update password if provided
            if ($request->has('password') && !empty($request->password)) {
                $userData['password'] = Hash::make($request->password);
            }

            $user = User::where('id', $request->customer_id)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found',
                ], 404);
            }
            $user->update($userData);

            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
