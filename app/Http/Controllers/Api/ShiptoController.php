<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ShiptoController extends Controller
{

    public function getShipToUsers($id)
    {
        $users = User::where('role_id', 5)
            ->where('status', 'Active')
            ->where('parent_customer_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function CreateShipTo(Request $request)
    {
        $validated = $request->validate(
            [
                'country' => 'required|string',
                'company_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'mobile_number_code_id' => 'required',
                'mobile_number' => 'required|digits:10|unique:users,phone',
                'alternative_mobile_number_code_id' => 'nullable',
                'alternative_mobile_number' => 'nullable|max:10',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email'
                ],
                'Model_ShipTo_address_1' => 'required|string|max:255',
                'ship_to_latitude' => 'required|numeric',
                'ship_to_longitude' => 'required|numeric',
                'language' => 'required|string',
            ],
            [
                'mobile_number.required' => 'The telephone field is required.',
                'mobile_number.digits' => 'The telephone must be exactly 10 digits.',
                'mobile_number.unique' => 'This telephone number is already taken.',
                'first_name.required' => 'Full name is required.',
                'Model_ShipTo_address_1.required' => 'Address 1 is required.',
                "ship_to_latitude.required" => "Latitude is required.",
                "ship_to_longitude.required" => "Longitude is required.",
            ]
        );

        try {
            $imagePaths = [];

            if ($request->hasFile('license_picture')) {
                $file = $request->file('license_picture');
                $fileName = time() . '_license.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                $imagePaths['license_picture'] = 'uploads/customer/' . $fileName;
            }

            $userData = [
                'name'       => $validated['first_name'],
                'email'      => $validated['email'],
                'phone'      => $validated['mobile_number'],
                'phone_2'    => $validated['alternative_mobile_number'] ?? null,
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'],
                'address'    => $validated['Model_ShipTo_address_1'],
                'address_2'  => $request->address_2,
                'latitude'   => $validated['ship_to_latitude'],
                'longitude'  => $validated['ship_to_longitude'],
                'language'   => $validated['language'],
                'company_name' => $validated['company_name'],
                'country_id'   => $validated['country'],
                'password'     => Hash::make('12345678'),
                'signup_type'  => 'for_admin',
                'role'         => 'ship_to_customer',
                'role_id'      => 5,

                // Optional fields
                'license_number' => $request->license ?? null,
                'apartment' => $request->apartment ?? null,
                'parent_customer_id' => $request->parent_customer_id ?? null,
                'license_document' => $imagePaths['license_picture'] ?? null,
            ];

            $user = User::create($userData);

            return response()->json([
                'success' => true,
                'message' => 'Ship to user created successfully.',
                'data' => $user,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create ShipTo user.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function CustomerCreateShipTo(Request $request)
    {
        $user = $this->user;
        $validated = $request->validate(
            [
                'country' => 'required|string',
                'company_name' => 'nullable|string|max:255',
                'first_name' => 'required|string|max:255',
                'mobile_number_code_id' => 'required',
                'mobile_number' => 'required|digits:10|unique:users,phone',
                'alternative_mobile_number_code_id' => 'nullable',
                'alternative_mobile_number' => 'nullable|max:10',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email'
                ],
                'ShipTo_address_1' => 'required|string|max:255',
                'ship_to_latitude' => 'required|numeric',
                'ship_to_longitude' => 'required|numeric',
                'state' => 'nullable|string',
                'city' => 'required|string',
                'Zip_code' => 'nullable|string|max:20',

            ],
            [
                'mobile_number.required' => 'The telephone field is required.',
                'mobile_number.digits' => 'The telephone must be exactly 10 digits.',
                'mobile_number.unique' => 'This telephone number is already taken.',
                'first_name.required' => 'Full name is required.',
                'ShipTo_address_1.required' => 'Address 1 is required.',
                "ship_to_latitude.required" => "Latitude is required.",
                "ship_to_longitude.required" => "Longitude is required.",
            ]
        );

        try {
            $imagePaths = [];

            if ($request->hasFile('license_picture')) {
                $file = $request->file('license_picture');
                $fileName = time() . '_license.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                $imagePaths['license_picture'] = 'uploads/customer/' . $fileName;
            }

            $userData = [
                'name'       => $validated['first_name'],
                'email'      => $validated['email'],
                'phone'      => $validated['mobile_number'],
                'phone_2'    => $validated['alternative_mobile_number'] ?? null,
                'phone_code_id'        => (int) $validated['mobile_number_code_id'],
                'phone_2_code_id_id'   => (int) $validated['alternative_mobile_number_code_id'],
                'address'    => $validated['ShipTo_address_1'],
                'address_2'  => $request->address_2,
                'latitude'   => $validated['ship_to_latitude'],
                'longitude'  => $validated['ship_to_longitude'],
                'language'   => $validated['language'] ?? null,
                'company_name' => $validated['company_name'],
                'country_id'   => $validated['country'],
                'password'     => Hash::make('12345678'),
                'signup_type'  => 'for_customer',
                'role'         => 'ship_to_customer',
                'role_id'      => 5,

                // Optional fields
                'license_number' => $request->license ?? null,
                'apartment' => $request->apartment ?? null,
                'parent_customer_id' => $user->id ?? null,
                'license_document' => $imagePaths['license_picture'] ?? null,
            ];

            $user = User::create($userData);

            insertAddress([
                'user_id' => $user->id,
                'address' => $validated['ShipTo_address_1'],
                'address_type' => 'delivery',
                'mobile_number' => $validated['mobile_number'] ?? null,
                'alternative_mobile_number' => $validated['alternative_mobile_number'] ?? null,
                'mobile_number_code_id'        =>   (int) $validated['mobile_number_code_id'],
                'alternative_mobile_number_code_id' => (int) $validated['alternative_mobile_number_code_id'],
                'city_id' =>  $validated['city'] ?? null,
                'country_id' =>  $validated['country'] ?? null,
                'full_name' => $validated['first_name'],
                'pincode' => $validated['Zip_code'] ?? null,
                'state_id' =>  $validated['state'] ?? null,
                'warehouse_id' => (int) $request->warehouse_id ?? null,
                'lat' => $validated['ship_to_latitude'] ?? null,
                'long' => $validated['ship_to_longitude'] ?? null,
                'type' => 'Services', // Default type
                'default_address' => 'No'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ship to user created successfully.',
                'data' => $user,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create ShipTo user.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function getCustomerShipToUsers(Request $request)
    {
        $request->validate([
            'country' => 'required'
        ]);
        $user = $this->user;

        $users = User::where('role_id', 5)->with('addresses')
            ->where('status', 'Active')
            ->where('parent_customer_id', $user->id)
            ->where('country_id', $request->country)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }
}
