<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $checkbox_status = $request->input('checkbox_status');

        // Initialize response tracking
        $response = [
            'success' => true,
            'message' => 'Status updated successfully.',
            'toggled' => [],
        ];

        $today = Carbon::now()->toDateString(); // current date
        // $today = "2025-04-25"; // for testing purpose
        // Toggle status for open container (if ID given)
        if ($openId) {
            $openVehicle = Vehicle::find($openId);
            if ($openVehicle) {
                $openVehicle->status = 'Active';
                if ($checkbox_status == 'only_open' || $checkbox_status == 'both_open_close') {
                    $openVehicle->open_date = $today;
                    $openVehicle->container_status = 20;
                }

                $openVehicle->save();

                $response['toggled'][] = [
                    'id' => $openVehicle->id,
                    'status' => $openVehicle->status,
                    'open_date' => $openVehicle->open_date
                ];
            }
        }

        // Inactivate close container (if ID given)
        if ($closeId) {
            $closeVehicle = Vehicle::find($closeId);
            if ($closeVehicle) {
                $closeVehicle->status = 'Inactive';
                
                if ($checkbox_status == 'only_close' || $checkbox_status == 'both_open_close') {
                    $closeVehicle->close_date = $today;
                    $closeVehicle->container_status = 0;
                }
                $closeVehicle->save();

                $response['toggled'][] = [
                    'id' => $closeVehicle->id,
                    'status' => $closeVehicle->status,
                    'close_date' => $closeVehicle->close_date
                ];
            }
        }

        return response()->json($response);
    }
}
