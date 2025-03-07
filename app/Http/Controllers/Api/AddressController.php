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
            'user_id' => 'required|integer',
            'address_type' => 'required|string',
        ]);

        $addresses = Address::where('user_id', $request->user_id)
            ->where('address_type', $request->address_type)
            ->with(['country', 'state', 'city'])
            ->get();

        if ($addresses->isEmpty()) {
            return response()->json(['message' => 'No addresses found'], 404);
        }

        return response()->json($addresses, 200);
    }

    public function createAddress(Request $request)
    {
        $address = Address::create($request->all());
        return $address;
    }
}
