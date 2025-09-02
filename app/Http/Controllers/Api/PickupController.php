<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\UserPickupDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PickupController extends Controller
{
    //
    public function getPickupUsers($id)
    {
        $users = Address::where('address_type', 'pickup')
            ->where('is_deleted', 'No')
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function CreatePickupAddress(Request $request)
    {
        $validated = $request->validate(
            [
                'company_name' => 'required|string|max:255',
                'full_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'mobile_number_code_id' => 'required',
                'mobile_number' => 'required|digits:10|unique:users,phone',
                'alternative_mobile_number_code_id' => 'nullable',
                'alternative_mobile_number' => 'nullable|max:10',
                'Model_Pickup_address_1' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'country' => 'required|string',
                'state' => 'required|string',
                'city' => 'required|string',
                'Zip_code' => 'nullable|string|max:10',
            ],
            [
                'mobile_number.required' => 'The telephone field is required.',
                'mobile_number.digits' => 'The telephone must be exactly 10 digits.',
                'mobile_number.unique' => 'This telephone number is already taken.',
                'full_name.required' => 'Full name is required.',
                'Model_Pickup_address_1.required' => 'Address 1 is required.',
            ]
        );

        try {
            // $userData = [
            //     'name'               => $validated['full_name'], // ✅ fixed
            //     'last_name'               => $validated['last_name'],
            //     'phone'              => $validated['mobile_number'],
            //     'phone_2'            => $request->alternate_mobile_no ?? null,
            //     'phone_code_id'      => (int) $validated['mobile_number_code_id'],
            //     'phone_2_code_id_id' => (int) $request->alternative_mobile_number_code_id,
            //     'address'            => $validated['Model_Pickup_address_1'],
            //     'address_2'          => $request->address_2,
            //     'latitude'           => $validated['latitude'],
            //     'longitude'          => $validated['longitude'],
            //     'company_name'       => $validated['company_name'],
            //     'country_id'         => $validated['country'],
            //     'state_id'           => $validated['state'], // ✅ fixed (was city before)
            //     'city_id'            => $validated['city'],
            //     'pincode'            => $validated['Zip_code'],
            //     'password'           => Hash::make('12345678'),
            //     'signup_type'        => 'for_admin',
            //     'role'               => 'pickup_to_customer',
            //     'role_id'            => 6,
            //     'apartment'          => $request->apartment ?? null,
            //     'parent_customer_id' => $request->parent_customer_id ?? null,
            // ];

            $userAddressData = [
                'address'        => $validated['Model_Pickup_address_1'],
                'address_type' => 'pickup',
                'alternative_mobile_number' => $request->alternate_mobile_no ?? null,
                'city_id' => $validated['city'],
                'country_id' => $validated['country'],
                'mobile_number' => $validated['mobile_number'],
                'pincode' => $validated['Zip_code'],
                'state_id' => $validated['state'],
                'lat' => $validated['latitude'],
                'long' => $validated['longitude'],
                'mobile_number_code_id'        => (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id'   => (int) $request->alternative_mobile_number_code_id,
                'apartment' => $request->apartment ?? null,
            ];

            $user = auth()->user();
            $userAddressData['user_id'] = $request->parent_customer_id;

            $userAddressData['name'] = trim($validated['full_name'] ?? '');
            $userAddressData['last_name'] = trim($validated['last_name'] ?? '');
            $userAddressData['full_name'] = $validated['full_name'] . ' ' . ($validated['last_name'] ?? '');



            // $user = User::create($userData);
            $address = Address::create($userAddressData);

            return response()->json([
                'success' => true,
                'message' => 'Ship to user created successfully.',
                'data' => $address,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
