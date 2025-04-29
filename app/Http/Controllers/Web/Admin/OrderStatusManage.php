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
use \Carbon\Carbon;

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
        


        $drivers = User::select('id', 'name', 'warehouse_id')
        ->with(['availabilities', 'weeklySchedules', 'locationSchedules'])
        ->where('warehouse_id', $nearestWarehouse->id)
        ->where('role_id', 4)
        ->where('status', 'Active')
        ->get()
        ->filter(function ($driver) use ($parcel) {
            $pickupDate = $parcel->pickup_date->format('Y-m-d');
            $pickupTime = $parcel->pickup_time; // e.g. "11:00 AM - 01:00 PM"
            $day = strtolower($parcel->pickup_date->format('l'));

            // Determine shift
            $timeRange = explode('-', $pickupTime);
            $startTime = Carbon::parse(trim($timeRange[0]));
            $endTime = Carbon::parse(trim($timeRange[1]));
            $hour = $startTime->hour;

            $shift = false;
            if ($hour < 12) {
                $shift = 'morning';
            } elseif ($hour < 17) {
                $shift = 'afternoon';
            } else {
                $shift = 'evening';
            }

            // Check availability on the specific date
            $availabilities = $driver->availabilities
                ->where('date', $pickupDate)
                ->values();

            // Check weekly schedule for the day and shift
            $weeklySchedules = $driver->weeklySchedules
                ->where('day', $day)
                ->filter(function ($schedule) use ($shift, $timeRange) {
                    return isset($schedule[$shift.'_start'], $schedule[$shift . '_end'])
                        && Carbon::parse(trim($schedule[$shift.'_start']))->hour <= Carbon::parse(trim($timeRange[0]))->hour 
                        && Carbon::parse(trim($schedule[$shift.'_end']))->hour >= Carbon::parse(trim($timeRange[1]))->hour;
                });
                
            // No availability record but has valid weekly schedule => include
            if ($availabilities->isEmpty() && $weeklySchedules->isNotEmpty()) {
                return true;
            }

            // Has availability for the shift and a valid weekly schedule => include
            if ($shift && $availabilities->where($shift,1)->isNotEmpty() && $weeklySchedules->isNotEmpty()) {
                return true;
            }

            return false;
        });




        // Step 6: Return response
        return response()->json([
            'message' => 'Driver list retrieved successfully',
            'drivers' => $drivers,
        ]);
    }

    public function statusUpdate_PickUpWithDriver(Request $request)
    {
       
            // Validate the request data
            $request->validate([
                'parcel_id' => 'required|exists:parcels,id',
                'driver_id' => 'required|exists:users,id',
                'created_user_id' => 'required|exists:users,id',
                'warehouse_id' => 'required|exists:warehouses,id',
                'notes' => 'nullable|string',
            ]);
    
            // Find the parcel by ID
            $parcel = Parcel::findOrFail($request->parcel_id);
    
            // Update the parcel details
            $parcel->update([
                'driver_id' => $request->driver_id,
                'status' => 2,
                'warehouse_id' => $request->warehouse_id,
            ]);

            // Create a new entry in ParcelHistory
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => $request->created_user_id,
                'customer_id' => $parcel->customer_id,
                'status' => 'Updated',
                'parcel_status' => 2,
                'note' => $request->notes ?? null,
                'warehouse_id' => $request->warehouse_id,
                'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);
    
            // Return success response
            return response()->json([
                'message' => 'Parcel and ParcelHistory updated successfully',
                'parcel' => $parcel,
            ]);
    }

    public function statusUpdate_ArrivedWarehouse(Request $request)
    {
       
            // Validate the request data
            $request->validate([
                'parcel_id' => 'required|exists:parcels,id',
                'created_user_id' => 'required|exists:users,id',
            ]);
    
            // Find the parcel by ID
            $parcel = Parcel::findOrFail($request->parcel_id);
    
            // Update the parcel details
            $parcel->update([
                'status' => 3,
            ]);


            $parcelHistory = ParcelHistory::where('parcel_id', $request->parcel_id)->first();
            // Create a new entry in ParcelHistory
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => $request->created_user_id,
                'customer_id' => $parcelHistory->customer_id,
                'status' => 'Updated',
                'parcel_status' => 3,
                'note' => null,
                'warehouse_id' => $parcelHistory->warehouse_id,
                'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);
    
            // Return success response
            return response()->json([
                'message' => 'Parcel updated successfully',
                'parcel' => $parcel,
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
