<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Parcel,
    Vehicle,
    ParcelHistory,
    HubTracking,
    Address
};

class OrderStatusManage extends Controller
{
    /**
     * Get drivers list based on parcel ID.
     */
    public function getDriversByParcelId(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
        ]);

        // Step 2: Find parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);

        // Step 3: Get pickup address details
        $pickupAddress = Address::find($parcel->pickup_address_id);
        if (!$pickupAddress) {
            return response()->json(['error' => 'Pickup address not found'], 404);
        }

        // Step 4: Find nearest warehouse
        $nearestWarehouse = $this->findNearestWarehouse($pickupAddress->lat, $pickupAddress->long);
        if (!$nearestWarehouse) {
            return response()->json(['error' => 'No warehouse found near the pickup address'], 404);
        }

        // Step 5: Find active drivers with matching warehouse_id and role_id = 4
        $drivers = User::select('id', 'name')->where('warehouse_id', $nearestWarehouse->id)
            ->where('role_id', 4)
            ->where('status', 'Active')
            ->get();

        // Step 6: Return response
        return response()->json([
            'message' => 'Driver list retrieved successfully',
            'drivers' => $drivers,
        ]);
    }

    /**
     * Helper function to find the nearest warehouse.
     */
    private function findNearestWarehouse($latitude, $longitude)
    {
        // Fetch all warehouses
        $warehouses = Warehouse::all();

        // Initialize variables to track the nearest warehouse
        $nearestWarehouse = null;
        $shortestDistance = PHP_FLOAT_MAX;

        // Loop through warehouses to calculate distance
        foreach ($warehouses as $warehouse) {
            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                $warehouse->lat,
                $warehouse->long
            );

            // Update nearest warehouse if current one is closer
            if ($distance < $shortestDistance) {
                $shortestDistance = $distance;
                $nearestWarehouse = $warehouse;
            }
        }

        return $nearestWarehouse;
    }

    /**
     * Helper function to calculate distance between two coordinates.
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Haversine formula to calculate distance in kilometers
        $earthRadius = 6371; // Radius of the Earth in km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in km
    }
}
