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

class CustomerController extends Controller
{
    public function getCustomers(Request $request)
    {
        $query = User::where('role', 'customer');

        if ($request->has('search') && !empty($request->query('search'))) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        $customers = $query->orderBy('name')->get(['id', 'name', 'phone', 'email', 'profile_pic']);

        foreach ($customers as $customer) {
            $address = Address::where('user_id', $customer->id)->with(['country', 'state', 'city'])->first();
            $customer->address = $address ? $address : null;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'role' => 'nullable|in:customer,driver',
            'role_id' => 'nullable|integer',
            'phone' => 'required|string|max:15|unique:users,phone',
            'phone_2' => 'nullable|string|max:15',
            'address' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'country_id' => 'required|string|max:255',
            // 'state_id' => 'required|string|max:255',
            // 'city_id' => 'required|string|max:255',
            'pincode' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->role = 'customer';
        $user->role_id = 3;
        $user->phone = $request->phone;
        $user->phone_2 = $request->phone_2;
        $user->address = $request->address;
        $user->address_2 = $request->address_2;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->pincode = $request->pincode;
        $user->password = \Hash::make('12345678');
        $user->save();
        return response()->json(['user' => $user], 200);
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
        Mail::to($email)->send(new RegistorMail($userName, $email, $mobileNumber, $password,$loginUrl));


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
