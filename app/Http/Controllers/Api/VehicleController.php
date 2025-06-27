<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Vehicle,
    ContainerSize,
};

class VehicleController extends Controller
{
    public function getWarehouseVehicles($id)
    {
        $vehicles = Vehicle::where('warehouse_id', $id)->with('vehicleType')->get();

        if ($vehicles->isEmpty()) {
            return response()->json([
                'message' => 'No vehicles found for this warehouse',
            ], 404);
        }

        return response()->json([
            'message' => 'Vehicles fetched successfully',
            'data' => $vehicles
        ]);
    }
}
