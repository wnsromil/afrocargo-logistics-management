<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Vehicle,
    ContainerSize,
};

class DriverController extends Controller
{
    public function getWarehouseDrivers($id)
    {
        $drivers = User::where('warehouse_id', $id)
            ->where('role_id', 4)
            ->get();

        if ($drivers->isEmpty()) {
            return response()->json([
                'message' => 'No drivers found for this warehouse',
            ], 404);
        }

        return response()->json([
            'message' => 'Drivers fetched successfully',
            'data' => $drivers
        ]);
    }
}
