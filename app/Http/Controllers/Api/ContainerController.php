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

    public function getAdminActiveContainers(Request $request)
    {
        $warehouseId = $request->input('warehouse_id'); // warehouse_id from request
        $container = Vehicle::where('status', 'Active')
            ->where('vehicle_type', 1)
            ->where('warehouse_id', $warehouseId)
            ->first();

        return response()->json([
            'message' => 'Active container fetched successfully',
            'container' => $container
        ]);
    }

    public function toggleStatus(Request $request)
    {
        $openId = $request->input('open_id');
        $closeId = $request->input('close_id');
        $warehouseId = $request->input('warehouseId');
        $checkbox_status = $request->input('checkbox_status');

        $response = [
            'success' => true,
            'message' => 'Status updated successfully.',
            'toggled' => [],
        ];

        $today = Carbon::now()->toDateString(); // current date

        // Step 1: If we're activating a container, first deactivate all containers in that warehouse
        if ($warehouseId && $openId) {
            Vehicle::where('warehouse_id', $warehouseId)
                ->where('id', '!=', $openId)
                ->update(['status' => 'Inactive']);
        }

        // Step 2: Activate selected open container
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

        // Step 3: Close selected container (if any)
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

    public function updateContainerInDateTime(Request $request)
    {
        // Validate input
        $request->validate([
            'container_id' => 'required|exists:vehicles,id',
            'container_in_date_time' => 'required|string',
        ]);

        // Vehicle model se record find karo
        $vehicle = Vehicle::find($request->container_id);

        // DateTime ko split karo (already validated)
        if ($request->container_in_date_time) {
            $dateTime = \Carbon\Carbon::createFromFormat('m/d/Y h:i A', $request->container_in_date_time);
            $containerInDate = $dateTime->format('Y-m-d');
            $containerInTime = $dateTime->format('H:i:s');

            // Columns me update karo
            $vehicle->container_in_date = $containerInDate;
            $vehicle->container_in_time = $containerInTime;
            $vehicle->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Container date and time updated successfully.',
        ]);
    }

    public function updateContainerOutDateTime(Request $request)
    {
        // Validate input
        $request->validate([
            'container_id' => 'required|exists:vehicles,id',
            'container_out_date_time' => 'required|string',
        ]);

        // Vehicle model se record find karo
        $vehicle = Vehicle::find($request->container_id);

        // DateTime ko split karo (already validated)
        if ($request->container_out_date_time) {
            $dateTime = \Carbon\Carbon::createFromFormat('m/d/Y h:i A', $request->container_out_date_time);
            $containerOutDate = $dateTime->format('Y-m-d');
            $containerOutTime = $dateTime->format('H:i:s');

            // Columns me update karo
            $vehicle->container_out_date = $containerOutDate;
            $vehicle->container_out_time = $containerOutTime;
            $vehicle->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Container date and time updated successfully.',
        ]);
    }
}
