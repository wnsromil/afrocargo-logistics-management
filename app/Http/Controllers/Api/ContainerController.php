<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ContainerHistory;

class ContainerController extends Controller
{
    public function getActiveContainers()
    {
        // Sirf active aur Container type vehicles fetch kar rahe hain
        $containers = Vehicle::where('status', 'Active')
            ->where('vehicle_type', '1')
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

        $today = Carbon::now()->toDateString();

        // STEP 1: Validate route conflict before opening
        if ($openId && $checkbox_status === 'only_open') {
            $openVehicle = Vehicle::find($openId);

            if ($openVehicle) {
                $shipTo = $openVehicle->ship_to_country;

                if (!is_null($shipTo)) {
                    $alreadyOpen = Vehicle::where('warehouse_id', $warehouseId)
                        ->where('id', '!=', $openVehicle->id)
                        ->where('status', 'Active')
                        ->where('ship_to_country', $shipTo)
                        ->first();

                    if ($alreadyOpen) {
                        return response()->json([
                            'success' => false,
                            'message' => "This route {$shipTo} container is already open.",
                        ]);
                    }
                }
            }
        }

        // STEP 2: Close container
        if ($closeId && $checkbox_status === 'only_close') {
            $closeVehicle = Vehicle::find($closeId);

            if ($closeVehicle) {
                $closeVehicle->status = 'Inactive';
                $closeVehicle->close_date = $today;
                $closeVehicle->container_status = 0;

                $containerHistory = ContainerHistory::where('container_id', $closeVehicle->id)
                    ->where('warehouse_id', $closeVehicle->warehouse_id)
                    ->where('type', 'Active')
                    ->first();

                if ($containerHistory) {
                    $containerHistory->update([
                        'type' => 'Inactive',
                        'close_date' => $today,
                    ]);
                }

                $closeVehicle->save();

                $response['toggled'][] = [
                    'id' => $closeVehicle->id,
                    'status' => $closeVehicle->status,
                    'close_date' => $closeVehicle->close_date
                ];
            }
        }

        // STEP 3: Open container
        if ($openId && $checkbox_status === 'only_open') {
            $openVehicle = Vehicle::find($openId);

            if ($openVehicle) {
                $openVehicle->status = 'Active';
                $openVehicle->open_date = $today;
                $openVehicle->container_status = 20;

                ContainerHistory::create([
                    'container_id' => $openVehicle->id,
                    'status' => 20,
                    'type' => 'Active',
                    'warehouse_id' => $openVehicle->warehouse_id,
                    'open_date' => $today,
                ]);

                $openVehicle->save();

                $response['toggled'][] = [
                    'id' => $openVehicle->id,
                    'status' => $openVehicle->status,
                    'open_date' => $openVehicle->open_date
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

    public function updateContainer(Request $request)
    {
        // Validate input
        $request->validate([
            'container_id' => 'required|exists:vehicles,id',
            'container_number' => 'nullable|string|max:255',
            'container_type' => 'nullable|string|max:255',
            'container_capacity' => 'nullable|numeric|min:0',
            'container_status' => 'nullable|integer',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'doc_id' => 'nullable|string|max:255',
            'bill_of_lading' => 'nullable|string|max:255',
        ]);

        // Vehicle model se record find karo
        $vehicle = Vehicle::find($request->container_id);

        // Update fields
        if ($request->container_number) {
            $vehicle->container_number = $request->container_number;
        }
        if ($request->container_in_date || $request->container_in_time) {
            $vehicle->container_in_date = $request->container_in_date ?? null;
            $vehicle->container_in_time = $request->container_in_time ?? null;
        }
        if ($request->container_type) {
            $vehicle->container_type = $request->container_type;
        }
        if ($request->container_capacity) {
            $vehicle->container_capacity = $request->container_capacity;
        }
        if ($request->warehouse_id) {
            $vehicle->warehouse_id = $request->warehouse_id;
        }
        if ($request->container_status) {
            $vehicle->container_status = $request->container_status;
        }
        if ($request->doc_id) {
            $vehicle->doc_id = $request->doc_id;
        }
        if ($request->bill_of_lading) {
            $vehicle->bill_of_lading = $request->bill_of_lading;
        }


        // Save changes
        $vehicle->save();

        return response()->json([
            'success' => true,
            'message' => 'Container updated successfully.',
            'container' => $vehicle,
        ]);
    }
}
