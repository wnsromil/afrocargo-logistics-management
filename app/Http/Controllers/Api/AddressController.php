<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function getAddress(Request $request)
    {
        $request->validate([
            'address_type' => 'required|string',
        ]);
        $user = $this->user;
        $addresses = Address::where('user_id', $user->id)
            ->where('address_type', $request->address_type)
            ->with(['country', 'state', 'city'])
            ->get();

        if ($addresses->isEmpty()) {
            return response()->json(['message' => 'No addresses found'], 404);
        }

        return response()->json($addresses, 200);
    }

    public function getAddressById($id)
    {
        $user = $this->user;

        // ✅ Find the address with matching ID & user_id, include relationships
        $address = Address::where('id', $id)
            ->where('user_id', $user->id)
            ->with(['country', 'state', 'city'])
            ->first();

        // ✅ Not Found
        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        // ✅ Return Address Detail
        return response()->json($address, 200);
    }


    public function createAddress(Request $request)
    {
        // ✅ Step 1: Validation
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'address_type' => 'required|string|in:pickup,delivery',
            'alternative_mobile_number' => 'nullable|string|max:15',
            'city_id' => 'required|string',
            'country_id' => 'required|string',
            'full_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'pincode' => 'required|string|max:10',
            'state_id' => 'required|string',
            'warehouse_id' => 'nullable|integer|exists:warehouses,id',
            'lat' => 'required',
            'long' => 'required',
        ]);

        // ✅ Step 2: Get Authenticated User
        $user = $this->user; // Laravel Auth system se current user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ✅ Step 3: Add User ID to Data
        $validatedData['user_id'] = $user->id;

        // ✅ Step 4: Insert Data
        $address = Address::create($validatedData);

        // ✅ Step 5: Return Response
        return response()->json([
            'message' => 'Address created successfully!',
            'data' => $address
        ], 201);
    }

    public function deleteAddress($id)
    {
        // ✅ Step 1: Get Authenticated User
        $user = $this->user; // Laravel Auth system se current user
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ✅ Step 2: Find Address by ID
        $address = Address::where('id', $id)->where('user_id', $user->id)->first();

        // ✅ Step 3: Check if Address Exists
        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        // ✅ Step 4: Delete Address
        $address->delete();

        // ✅ Step 5: Return Response
        return response()->json(['message' => 'Address deleted successfully!'], 200);
    }

    public function updateAddress(Request $request, $id)
    {
        // ✅ Step 1: Get Authenticated User
        $user = $this->user;
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ✅ Step 2: Find Address by ID & User
        $address = Address::where('id', $id)->where('user_id', $user->id)->first();
        if (!$address) {
            return response()->json(['message' => 'Address not found or unauthorized'], 404);
        }

        // ✅ Step 3: Validation (same as createAddress)
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'address_type' => 'required|string|in:pickup,delivery',
            'alternative_mobile_number' => 'nullable|string|max:15',
            'city_id' => 'required|string',
            'country_id' => 'required|string',
            'full_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'pincode' => 'required|string|max:10',
            'state_id' => 'required|string',
            'warehouse_id' => 'nullable|integer|exists:warehouses,id',
            'lat' => 'required',
            'long' => 'required',
        ]);

        // ✅ Step 4: Update Address
        $address->update($validatedData);

        // ✅ Step 5: Return Response
        return response()->json([
            'message' => 'Address updated successfully!',
            'data' => $address
        ], 200);
    }
}
