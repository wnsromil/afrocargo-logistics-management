<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PickupController extends Controller
{
    //
    public function getPickupUsers($id)
    {
        $users = User::where('role_id', 6)
            ->where('status', 'Active')
            ->where('parent_customer_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }


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
}
