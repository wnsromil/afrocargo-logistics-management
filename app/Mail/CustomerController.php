<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Parcel;
use App\Models\ShippingUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistorMail;
use Hash;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function getCustomers(Request $request)
    {
        $request->validate([
            'invoice_custmore_type' => 'nullable|in:from_to,ship_to,all',
            'invoice_custmore_id' => 'nullable|integer',
            'search' => 'nullable|string|max:255',
        ]);

        $type = $request->query('invoice_custmore_type');
        $invoiceCustomerId = $request->query('invoice_custmore_id');

        $query = User::where('role', 'customer');

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
                    ->orWhere('phone', 'LIKE', "%$search%")
                    ->orWhere('address', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        $customers = $query->orderBy(column: 'name')->get(['id', 'name', 'phone', 'phone_2', 'email', 'profile_pic', 'signature_img', 'contract_signature_img', 'license_document']);

        foreach ($customers as $customer) {
            $address = Address::where('user_id', $customer->id)->with(['country', 'state', 'city'])->first();
            $customer->address = $address ?? null;
        }

        return response()->json(['customers' => $customers], 200);
    }

    public function getCustomersDetails(Request $request)
    {
        if ($request->has('id') && !empty($request->id)) {
            $customer = User::where('role', 'customer')->where('id', $request->id)->first();

            if (!$customer) {
                return response()->json(['message' => 'No customer found'], 404);
            }

            return response()->json(['customer' => $customer], 200);
        }

        return response()->json(['message' => 'ID is required'], 400);
    }

    public function createCustomer(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'mobile_code' => 'required|max:13|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'alternate_mobile_no' => 'nullable|max:13',
            'address' => 'required|string|max:255',
            'country' => 'required|string|exists:countries,id',
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

            $userData = [
                'name' => $validated['first_name'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['mobile_code'],
                'phone_2' => $validated['alternate_mobile_no'] ?? null,
                'address' => $validated['address'],
                'address_2' => $request->Address_2,
                'country_id' => $validated['country'],
                'state_id' => $validated['state'],
                'city_id' => $validated['city'],
                'pincode' => $validated['Zip_code'],
                'password' => Hash::make(12345678),
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
            ];

            if (!empty($request->license_expiry_date)) {
                $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
            }

            if (!empty($request->signature_date)) {
                $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
            }

            $user = User::create($userData);

            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createShippingCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
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
}
