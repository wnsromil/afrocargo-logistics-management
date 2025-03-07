<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;

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

        $customers = $query->orderBy('name')->get(['id', 'name']);

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

    public function createCustomer($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required|in:customer,driver',
            'phone' => 'required|string|max:15|unique:users,phone',
            'address' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'pincode' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        return User::create($request->only(['name', 'email', 'user_type', 'phone', 'address', 'country_id', 'state_id', 'city_id', 'pincode']));
    }
}
