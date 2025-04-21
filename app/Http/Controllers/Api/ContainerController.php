<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function getActiveContainers()
    {
        // Sirf active aur Container type vehicles fetch kar rahe hain
        $containers = Vehicle::where('status', 'Active')
            ->where('vehicle_type', 'Container')
            ->get();

        return response()->json([
            'message' => 'Active Containers fetched successfully',
            'containers' => $containers
        ]);
    }

    public function getAdminActiveContainers()
    {
        // Sirf ek hi active container chahiye
        $container = Vehicle::where('status', 'Active')
            ->where('vehicle_type', 'Container')
            ->first(); // <-- only first result

        return response()->json([
            'message' => 'Active container fetched successfully',
            'container' => $container
        ]);
    }


    public function toggleStatus(Request $request)
    {
        $openId = $request->input('open_id');
        $closeId = $request->input('close_id');

        // Initialize response tracking
        $response = [
            'success' => true,
            'message' => 'Status updated successfully.',
            'toggled' => [],
        ];

        // Toggle status for open container (if ID given)
        if ($openId) {
            $openVehicle = Vehicle::find($openId);
            if ($openVehicle) {
                $openVehicle->status = $openVehicle->status === 'Active' ? 'Inactive' : 'Active';
                $openVehicle->save();

                $response['toggled'][] = [
                    'id' => $openVehicle->id,
                    'new_status' => $openVehicle->status
                ];
            }
        }

        // Inactivate close container (if ID given)
        if ($closeId) {
            $closeVehicle = Vehicle::find($closeId);
            if ($closeVehicle) {
                $closeVehicle->status = 'Inactive';
                $closeVehicle->save();

                $response['toggled'][] = [
                    'id' => $closeVehicle->id,
                    'new_status' => $closeVehicle->status
                ];
            }
        }

        return response()->json($response);
    }
}
