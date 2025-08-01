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
    Address,
    ContainerHistory,
    ParcelPickupDriver,
    ParcelSignaturePickup,
    ParcelInventorie,
    NotificationParcelMessage,
    Notification
};
use \Carbon\Carbon;

use function Laravel\Prompts\note;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; // agar Intervention Image package use karte ho

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
        $drivers = User::select('id', 'name', 'warehouse_id')->where('warehouse_id', $nearestWarehouse->id)
            ->where('role_id', 4)
            ->where('status', 'Active')
            ->get();

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

        $DriverData = User::where('id', $request->driver_id)->first();
        $notificationOrderAssigned = NotificationParcelMessage::find(4);
        $deviceTokenOrderAssigned = $DriverData->firebase_token;
        $titleOrderAssigned = $notificationOrderAssigned->title;
        $formattedDate = Carbon::parse($parcel->pickup_date)->format('d-m-Y');
        $bodyOrderAssigned = str_replace(
            ['{order_id}', '{pickup_date}', '{pickup_time}'],
            [$parcel->tracking_number, $formattedDate, $parcel->pickup_time],
            $notificationOrderAssigned->message
        );

        if (!empty($deviceTokenOrderAssigned)) {
            sendFirebaseNotification($deviceTokenOrderAssigned, $titleOrderAssigned, $bodyOrderAssigned, $DriverData->id, $parcel->id, 'Order Assigned');
        }

        $CustomerData = User::where('id', $parcel->customer_id)->first();
        $notificationDriverAssigned = NotificationParcelMessage::find(3);
        $deviceTokenDriverAssigned = $CustomerData->firebase_token;
        $titleDriverAssigned = $notificationDriverAssigned->title;
        $bodyDriverAssigned = str_replace('{driver_name}', ($DriverData->name ?? '') . ' ' . ($DriverData->last_name ?? ''), $notificationDriverAssigned->message);

        if (!empty($deviceTokenDriverAssigned)) {
            sendFirebaseNotification($deviceTokenDriverAssigned, $titleDriverAssigned, $bodyDriverAssigned, $parcel->customer_id, $parcel->id, 'Driver Assigned');
        }

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
            'status' => 4,
        ]);

        ParcelPickupDriver::where('parcel_id', $request->parcel_id)
            ->where('container_id', $parcel->container_id)
            ->update(['status' => 4]);

        ParcelInventorie::where('parcel_id', $request->parcel_id)
            ->where('container_id', $parcel->container_id)
            ->update(['status' => 4]);

        $parcelHistory = ParcelHistory::where('parcel_id', $request->parcel_id)->first();
        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $request->created_user_id,
            'customer_id' => $parcelHistory->customer_id,
            'status' => 'Updated',
            'parcel_status' => 4,
            'note' => null,
            'warehouse_id' => $parcelHistory->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        $CustomerData = User::where('id', $parcel->customer_id)->first();
        $WarehouseData = Warehouse::where('id', $parcel->warehouse_id)->first();
        $notificationWarehouseArrived = NotificationParcelMessage::find(6);
        $deviceTokenWarehouseArrived = $CustomerData->firebase_token;
        $titleDriverWarehouseArrived = $notificationWarehouseArrived->title;
        $bodyDriverWarehouseArrived = str_replace('{warehouse_name}', ($WarehouseData->warehouse_name ?? ''), $notificationWarehouseArrived->message);

        if (!empty($deviceTokenWarehouseArrived)) {
            sendFirebaseNotification($deviceTokenWarehouseArrived, $titleDriverWarehouseArrived, $bodyDriverWarehouseArrived, $CustomerData->id, $parcel->id, 'Warehouse Arrived');
        }

        // Return success response
        return response()->json([
            'message' => 'Parcel updated successfully',
            'parcel' => $parcel,
        ]);
    }

    public function fetchTransferToHubData(Request $request)
    {
        $vehicleId = $request->vehicleId;

        // Step 1: Vehicle with warehouse
        $vehicle = Vehicle::with('warehouse')->find($vehicleId);
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        // Step 2: All Active Warehouses
        $warehouses = Warehouse::where('status', 'Active')
            ->where('id', '!=', $vehicle->warehouse_id) // Exclude current warehouse
            ->get();

        // Step 3: Users with same warehouse_id, role_id = 4 and status = Active
        $drivers = User::where('warehouse_id', $vehicle->warehouse_id)
            ->where('role_id', 4)
            ->where('status', 'Active')
            ->get();

        return response()->json([
            'vehicle' => $vehicle,
            'warehouses' => $warehouses,
            'drivers' => $drivers
        ]);
    }

    public function statusUpdate_transferToHub(Request $request)
    {
        // Step 1: Validate input
        $validated = $request->validate([
            'from_warehouse_id' => 'required|exists:warehouses,id',
            'to_warehouse_id' => 'required|exists:warehouses,id',
            'delivery_man' => 'nullable|exists:users,id',
            'note' => 'nullable|string',
            'vehicle_id_hidden' => 'required|exists:vehicles,id',
            'partial_payment_sum_input_hidden' => 'required',
            'remaining_payment_sum_input_hidden' => 'required',
            'total_amount_sum_input_hidden' => 'required',
            'no_of_orders_input_hidden' => 'required',

        ]);

        // Step 2: Find the vehicle
        $vehicle = Vehicle::findOrFail($validated['vehicle_id_hidden']);

        $vehicleData = $vehicle->toJson(); // store full parcel data in description

        // 2. Transfer record
        $TransfercontainerHistory = ContainerHistory::find($request->containerHistoryId);

        if ($TransfercontainerHistory) {
            $TransfercontainerHistory->update([
                'transfer_date'         => now()->format('Y-m-d'),
                'driver_id'             => $validated['delivery_man'] ?? null,
                'status'                => 17,
                'type'                  => 'Transfer',
                'description'           => $vehicleData,
                'arrived_warehouse_id'  => $validated['to_warehouse_id'],
                'note'                  => $validated['note'],
                ''
            ]);
        }

        // 2. Arrived record
        $containerHistory = ContainerHistory::create([
            'container_id' => $vehicle->id,
            'transfer_date' => now()->format('Y-m-d'),
            'driver_id' => $validated['delivery_man'] ?? null,
            'status' => 5,
            'type' => 'Arrived',
            'no_of_orders' => $validated['no_of_orders_input_hidden'],
            'description' => $vehicleData,
            'warehouse_id' => $validated['from_warehouse_id'],
            'arrived_warehouse_id' => $validated['to_warehouse_id'],
            'partial_payment' => $validated['partial_payment_sum_input_hidden'],
            'remaining_payment' => $validated['remaining_payment_sum_input_hidden'],
            'total_amount' => $validated['total_amount_sum_input_hidden'],
            'note' => $validated['note'],
            'open_date' => $TransfercontainerHistory->open_date,
            'close_date' => $TransfercontainerHistory->close_date,
        ]);

        // Step 3: Update vehicle table
        $vehicle->update([
            'transfer_date' => now()->format('Y-m-d'),
            'close_date' => now()->format('Y-m-d'),
            'note' => $validated['note'],
            'arrived_warehouse_id' => $validated['to_warehouse_id'],
            'container_status' => 17,
            'status' => 'Inactive',
        ]);

        // Step 4: Find all parcels related to this container and update their status to 5
        $parcels = Parcel::where('container_id', $vehicle->id)->where('status', 16)->get();

        foreach ($parcels as $parcel) {
            ParcelPickupDriver::where('parcel_id', $parcel->id)
                ->where('container_id', $parcel->container_id)
                ->update(['status' => 5]);

            ParcelInventorie::where('parcel_id', $parcel->id)
                ->where('container_id', $parcel->container_id)
                ->update(['status' => 5]);

            $parcel->update([
                'status' => 5,
                'arrived_container_history_id' => $containerHistory->id,
                'arrived_warehouse_id' => $validated['to_warehouse_id'],
            ]);
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $parcel->customer_id,
                'status' => 'Updated',
                'parcel_status' => 5,
                'note' => $validated['note'] ?? null,
                'warehouse_id' => $vehicle->warehouse_id,
                'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            if ($parcel->status === 5) {
                $CustomerData = User::where('id', $parcel->customer_id)->first();
                $notificationInTransit = NotificationParcelMessage::find(7);
                $deviceTokenInTransit = $CustomerData->firebase_token;
                $titleDriverInTransit = $notificationInTransit->title;
                $bodyDriverInTransit = $notificationInTransit->message;

                if (!empty($deviceTokenInTransit)) {
                    sendFirebaseNotification($deviceTokenInTransit, $titleDriverInTransit, $bodyDriverInTransit, $CustomerData->id, $parcel->id, 'In transit');
                }
            }
        }

        // Fetch notification template safely
        $WarehousenotificationInTransit = NotificationParcelMessage::find(32);

        if ($WarehousenotificationInTransit && $vehicle) {
            $title = str_replace('{container_id}', $Vehicle->container_no_1 ?? '', $WarehousenotificationInTransit->title);
            $message = str_replace('{container_id}', $Vehicle->container_no_1 ?? '', $WarehousenotificationInTransit->message);

            Notification::create([
                'user_id' => null,
                'warehouse_id' => $request->to_warehouse_id,
                'title' => $title,
                'message' => $message,
                'notification_for' => 'All Warehouse Managers',
                'role' => 'Warehouse Manager',
                'type' => 'In transit',
            ]);

            $users = User::where('role_id', 2)
                ->where('warehouse_id', $request->to_warehouse_id)
                ->get();

            foreach ($users as $user) {
                User::where('id', $user->id)->increment('notification_read', 1);
            }
        }


        return response()->json(['message' => 'Transfer to hub completed successfully.']);
    }

    public function statusUpdate_receivedToHub(Request $request)
    {
        // Step 1: Validate input
        $validated = $request->validate([
            'vehicle_id_hidden' => 'required|exists:vehicles,id',
            'note' => 'nullable|string',
        ]);

        // Step 2: Find the vehicle
        $vehicle = Vehicle::findOrFail($validated['vehicle_id_hidden']);

        // Step 3: Update vehicle table
        $vehicle->update([
            'note' => $validated['note'],
            'container_status' => 18,
        ]);

        // Step 4: Find all parcels related to this container and update their status to 5
        $parcels = Parcel::where('container_id', $vehicle->id)->get();

        foreach ($parcels as $parcel) {
            $parcel->update(['status' => 8]);
            ParcelPickupDriver::where('parcel_id', $parcel->id)
                ->where('container_id', $parcel->container_id)
                ->update(['status' => 8]);
            ParcelInventorie::where('parcel_id', $parcel->id)
                ->where('container_id', $parcel->container_id)
                ->update(['status' => 8]);
            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $parcel->customer_id,
                'status' => 'Updated',
                'parcel_status' => 8,
                'note' => $validated['note'] ?? null,
                'warehouse_id' => $vehicle->warehouse_id,
                'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            if ($parcel->status === 8) {
                $CustomerData = User::where('id', $parcel->customer_id)->first();
                $notificationFinalDestination = NotificationParcelMessage::find(10);
                $deviceTokenFinalDestination = $CustomerData->firebase_token;
                $titleDriverFinalDestination = $notificationFinalDestination->title;
                $bodyDriverFinalDestination = str_replace('{container_number}', ($Vehicle->container_no_1 ?? ''), $notificationFinalDestination->message);

                if (!empty($deviceTokenFinalDestination)) {
                    sendFirebaseNotification($deviceTokenFinalDestination, $titleDriverFinalDestination, $bodyDriverFinalDestination, $CustomerData->id, $parcel->id, 'Arrived at final destination warehouse');
                }
            }
        }

        // Step 6a: Update only latest Transfer record
        $latestTransfer = ContainerHistory::where('container_id', $vehicle->id)
            ->where('type', 'Transfer')
            ->where('status', [17, 24, 33])
            ->latest('id')  // or 'created_at' if you prefer
            ->first();

        if ($latestTransfer) {
            $latestTransfer->update([
                'status' => 19,
                'note' => $validated['note'],
                'arrived_container' => 'Yes',
            ]);
        }

        // Step 6b: Update only latest Arrived record
        $latestArrived = ContainerHistory::where('container_id', $vehicle->id)
            ->where('type', 'Arrived')
            ->whereIn('status', [5, 24, 33])
            ->latest('id')
            ->first();

        if ($latestArrived) {
            $latestArrived->update([
                'status' => 18,
                'note' => $validated['note'],
                'arrived_container' => 'Yes',
            ]);
        }



        return response()->json(['message' => 'Received to hub completed successfully.']);
    }

    public function statusUpdate_fullyloadedcontainer(Request $request)
    {

        // Validate the request data
        $request->validate([
            'vehicleId' => 'required|exists:vehicles,id',
        ]);

        // Find the parcel by ID
        $Vehicle = Vehicle::findOrFail($request->vehicleId);

        // Update the parcel details
        $Vehicle->update([
            'container_status' => 16,
        ]);

        $TransfercontainerHistory = ContainerHistory::find($request->containerHistoryId);

        if ($TransfercontainerHistory) {
            $TransfercontainerHistory->update([
                'close_date'         => now()->format('Y-m-d'),
            ]);
            Parcel::where('container_history_id', $TransfercontainerHistory->id)
                ->update(['status' => 16]);

            $parcels = Parcel::where('container_history_id', $TransfercontainerHistory->id)->get();
            $q = [];
            foreach ($parcels as $parcel) {
                $q[] = [
                    'parcel_id' => $parcel->id,
                    'created_user_id' => auth()->id(),
                    'customer_id' => $parcel->customer_id,
                    'status' => 'Updated',
                    'parcel_status' => 16,
                    'note' =>  null,
                    'warehouse_id' => $Vehicle->warehouse_id,
                    'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
                ];

                if ($parcel->status == 16) {
                    $CustomerData = User::where('id', $parcel->customer_id)->first();
                    $notificationContainerFullLoad = NotificationParcelMessage::find(16);
                    $deviceTokenContainerFullLoad = $CustomerData->firebase_token;
                    $titleDriverContainerFullLoad = $notificationContainerFullLoad->title;
                    $bodyDriverContainerFullLoad = $notificationContainerFullLoad->message;

                    if (!empty($deviceTokenContainerFullLoad)) {
                        sendFirebaseNotification($deviceTokenContainerFullLoad, $titleDriverContainerFullLoad, $bodyDriverContainerFullLoad, $CustomerData->id, $parcel->id, 'Ready to transfer');
                    }
                }
            }
            ParcelHistory::insert($q);
        }
        // Return success response
        return response()->json([
            'message' => 'Container status updated successfully',
            'parcel' => $Vehicle,
        ]);
    }

    public function statusUpdate_customhold(Request $request)
    {
        $request->validate([
            'vehicleId' => 'required|exists:vehicles,id',
            'containerHistoryId' => 'required',
        ]);

        $Vehicle = Vehicle::findOrFail($request->vehicleId);
        $Vehicle->update([
            'container_status' => 24,
        ]);

        $TransfercontainerHistory = ContainerHistory::find($request->containerHistoryId);

        if ($TransfercontainerHistory) {
            // Update current container history
            $TransfercontainerHistory->update([
                'container_status' => 24,
            ]);

            // Update parcels for this history
            Parcel::where('container_history_id', $TransfercontainerHistory->id)
                ->update(['status' => 24]);

            // Get related IDs from this history
            $containerId = $TransfercontainerHistory->container_id;
            $warehouseId = $TransfercontainerHistory->warehouse_id;
            $arrivedWarehouseId = $TransfercontainerHistory->arrived_warehouse_id;

            // Find and update other Arrived-type container histories
            $relatedHistories = ContainerHistory::where('container_id', $containerId)
                ->where('warehouse_id', $warehouseId)
                ->where('arrived_warehouse_id', $arrivedWarehouseId)
                ->where('type', 'Arrived')
                ->get();

            foreach ($relatedHistories as $history) {
                $history->update(['status' => 24]);

                Parcel::where('container_history_id', $history->id)
                    ->update(['status' => 24]);
            }

            $parcels = Parcel::where('container_history_id', $TransfercontainerHistory->id)->get();
            foreach ($parcels as $parcel) {
                if ($parcel->status === 24) {
                    $CustomerData = User::where('id', $parcel->customer_id)->first();
                    $notificationInTransit = NotificationParcelMessage::find(id: 23);
                    $deviceTokenInTransit = $CustomerData->firebase_token;
                    $titleDriverInTransit = $notificationInTransit->title;
                    $bodyDriverInTransit = $notificationInTransit->message;

                    if (!empty($deviceTokenInTransit)) {
                        sendFirebaseNotification($deviceTokenInTransit, $titleDriverInTransit, $bodyDriverInTransit, $CustomerData->id, $parcel->id, 'Custom hold');
                    }
                }
            }
        }

        $WarehousenotificationInTransit = NotificationParcelMessage::find(33);

        if ($WarehousenotificationInTransit && $Vehicle) {
            $title = str_replace('{container_id}', $Vehicle->container_no_1 ?? '', $WarehousenotificationInTransit->title);
            $message = str_replace('{container_id}', $Vehicle->container_no_1 ?? '', $WarehousenotificationInTransit->message);

            Notification::create([
                'user_id' => null,
                'warehouse_id' => $arrivedWarehouseId,
                'title' => $title,
                'message' => $message,
                'notification_for' => 'All Warehouse Managers',
                'role' => 'Warehouse Manager',
                'type' => 'Custom Hold',
            ]);

            $users = User::where('role_id', 2)
                ->where('warehouse_id', $arrivedWarehouseId)
                ->get();

            foreach ($users as $user) {
                User::where('id', $user->id)->increment('notification_read', 1);
            }
        }


        return response()->json([
            'message' => 'Container and related data marked as Custom Hold successfully.',
            'parcel' => $Vehicle,
        ]);
    }

    public function statusUpdate_customcleared(Request $request)
    {
        $request->validate([
            'vehicleId' => 'required|exists:vehicles,id',
            'containerHistoryId' => 'required',
        ]);

        $Vehicle = Vehicle::findOrFail($request->vehicleId);
        $Vehicle->update([
            'container_status' => 33,
        ]);

        $TransfercontainerHistory = ContainerHistory::find($request->containerHistoryId);

        if ($TransfercontainerHistory) {
            // Update parcel status for this history
            Parcel::where('container_history_id', $TransfercontainerHistory->id)
                ->update(['status' => 33]);

            // Get related IDs from this history
            $containerId = $TransfercontainerHistory->container_id;
            $warehouseId = $TransfercontainerHistory->warehouse_id;
            $arrivedWarehouseId = $TransfercontainerHistory->arrived_warehouse_id;

            // Find and update other Arrived-type container histories
            $relatedHistories = ContainerHistory::where('container_id', $containerId)
                ->where('warehouse_id', $warehouseId)
                ->where('arrived_warehouse_id', $arrivedWarehouseId)
                ->where('type', 'Arrived')
                ->get();

            foreach ($relatedHistories as $history) {
                $history->update(['status' => 33]);

                Parcel::where('container_history_id', $history->id)
                    ->update(['status' => 33]);
            }

            $parcels = Parcel::where('container_history_id', $TransfercontainerHistory->id)->get();
            foreach ($parcels as $parcel) {
                if ($parcel->status === 33) {
                    $CustomerData = User::where('id', $parcel->customer_id)->first();
                    $notificationInTransit = NotificationParcelMessage::find(id: 30);
                    $deviceTokenInTransit = $CustomerData->firebase_token;
                    $titleDriverInTransit = $notificationInTransit->title;
                    $bodyDriverInTransit = $notificationInTransit->message;

                    if (!empty($deviceTokenInTransit)) {
                        sendFirebaseNotification($deviceTokenInTransit, $titleDriverInTransit, $bodyDriverInTransit, $CustomerData->id, $parcel->id, 'Custom cleared');
                    }
                }
            }

            $WarehousenotificationInTransit = NotificationParcelMessage::find(34);

            if ($WarehousenotificationInTransit && $Vehicle) {
                $title = str_replace('{container_id}', $Vehicle->container_no_1 ?? '', $WarehousenotificationInTransit->title);
                $message = str_replace('{container_id}', $Vehicle->container_no_1 ?? '', $WarehousenotificationInTransit->message);

                Notification::create([
                    'user_id' => null,
                    'warehouse_id' => $arrivedWarehouseId,
                    'title' => $title,
                    'message' => $message,
                    'notification_for' => 'All Warehouse Managers',
                    'role' => 'Warehouse Manager',
                    'type' => 'Custom Cleared',
                ]);

                $users = User::where('role_id', 2)
                    ->where('warehouse_id', $arrivedWarehouseId)
                    ->get();

                foreach ($users as $user) {
                    User::where('id', $user->id)->increment('notification_read', 1);
                }
            }
        }

        return response()->json([
            'message' => 'Container and related data marked as Customs Cleared successfully.',
            'parcel' => $Vehicle,
        ]);
    }

    public function statusUpdate_fullydischargecontainer(Request $request)
    {

        // Validate the request data
        $request->validate([
            'vehicleId' => 'required|exists:vehicles,id',
        ]);

        // Find the parcel by ID
        $Vehicle = Vehicle::findOrFail($request->vehicleId);

        // Update the parcel details
        $Vehicle->update([
            'container_status' => 7,
        ]);

        $latestArrived = ContainerHistory::where('container_id', $Vehicle->id)
            ->where('type', 'Arrived')
            ->where('status', operator: 18)
            ->latest('id')
            ->first();

        if ($latestArrived) {
            $latestArrived->update([
                'status' => 7,
                'full_discharge' => "Yes"
            ]);
        }

        $parcels = Parcel::where('container_id', $Vehicle->id)->get();

        foreach ($parcels as $parcel) {
            $parcel_status_id = '';
            if ($parcel->delivery_type == 'self') {
                $parcel->update(['status' => 21]);
                $parcel_status_id = 21;
                ParcelPickupDriver::where('parcel_id', $parcel->id)
                    ->where('container_id', $parcel->container_id)
                    ->update(['status' => 21]);
                ParcelInventorie::where('parcel_id', $parcel->id)
                    ->where('container_id', $parcel->container_id)
                    ->update(['status' => 21]);

                if ($parcel->status == 21) {
                    $CustomerData = User::where('id', $parcel->customer_id)->first();
                    $notificationReadyForSelfPickup = NotificationParcelMessage::find(21);
                    $deviceTokenReadyForSelfPickup = $CustomerData->firebase_token;
                    $titleReadyForSelfPickup = $notificationReadyForSelfPickup->title;
                    $bodyReadyForSelfPickup = $notificationReadyForSelfPickup->message;

                    if (!empty($deviceTokenReadyForSelfPickup)) {
                        sendFirebaseNotification($deviceTokenReadyForSelfPickup, $titleReadyForSelfPickup, $bodyReadyForSelfPickup, $CustomerData->id, $parcel->id, 'Ready for self pick up');
                    }
                }
            } else {
                $parcel->update(['status' => 9]);
                $parcel_status_id = 9;
                ParcelPickupDriver::where('parcel_id', $parcel->id)
                    ->where('container_id', $parcel->container_id)
                    ->update(['status' => 9]);
                ParcelInventorie::where('parcel_id', $parcel->id)
                    ->where('container_id', $parcel->container_id)
                    ->update(['status' => 9]);
            }

            ParcelHistory::create([
                'parcel_id' => $parcel->id,
                'created_user_id' => auth()->id(),
                'customer_id' => $parcel->customer_id,
                'status' => 'Updated',
                'parcel_status' => $parcel_status_id,
                'note' => $validated['note'] ?? null,
                'warehouse_id' => $Vehicle->warehouse_id,
                'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
            ]);

            if ($parcel->status == 9) {
                $CustomerData = User::where('id', $parcel->customer_id)->first();
                $notificationReadyForSelfPickup = NotificationParcelMessage::find(11);
                $deviceTokenReadyForSelfPickup = $CustomerData->firebase_token;
                $titleReadyForSelfPickup = $notificationReadyForSelfPickup->title;
                $bodyReadyForSelfPickup = $notificationReadyForSelfPickup->message;

                if (!empty($deviceTokenReadyForSelfPickup)) {
                    sendFirebaseNotification($deviceTokenReadyForSelfPickup, $titleReadyForSelfPickup, $bodyReadyForSelfPickup, $CustomerData->id, $parcel->id, 'Final destination pick up');
                }
            }
        }


        // Return success response
        return response()->json([
            'message' => 'Container status updated successfully',
            'parcel' => $Vehicle,
        ]);
    }

    public function getDeliveryDriversByParcelId(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
        ]);

        // Step 2: Find parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);

        // Step 3: Get pickup address details
        $deliveryAddress = Address::find($parcel->delivery_address_id);
        if (!$deliveryAddress) {
            return response()->json(['error' => 'Delivery address not found'], 404);
        }

        // Step 4: Find nearest warehouse
        $nearestWarehouse = $this->findNearestWarehouse($deliveryAddress->lat, $deliveryAddress->long);
        if (!$nearestWarehouse) {
            return response()->json(['error' => 'No warehouse found near the pickup address'], 404);
        }

        // Step 5: Find active drivers with matching warehouse_id and role_id = 4
        $drivers = User::select('id', 'name', 'warehouse_id')->where('warehouse_id', $nearestWarehouse->id)
            ->where('role_id', 4)
            ->where('status', 'Active')
            ->get();

        // Step 6: Return response
        return response()->json([
            'message' => 'Driver list retrieved successfully',
            'drivers' => $drivers,
        ]);
    }

    public function statusUpdate_DeliveryWithDriver(Request $request)
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

        //$otp = rand(1000, 9999);
        $otp = 1234;

        // Update the parcel details
        $parcel->update([
            'arrived_driver_id' => $request->driver_id,
            'status' => 22,
            'arrived_warehouse_id' => $request->warehouse_id,
            'otp' => $otp
        ]);

        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $request->created_user_id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 22,
            'note' => $request->notes ?? null,
            'warehouse_id' => $request->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        $DriverData = User::where('id', $request->driver_id)->first();
        $notificationOrderAssigned = NotificationParcelMessage::find(31);
        $deviceTokenOrderAssigned = $DriverData->firebase_token;
        $titleOrderAssigned = $notificationOrderAssigned->title;
        $bodyOrderAssigned = str_replace(
            '{order_id}',
            $parcel->tracking_number,
            $notificationOrderAssigned->message
        );

        if (!empty($deviceTokenOrderAssigned)) {
            sendFirebaseNotification($deviceTokenOrderAssigned, $titleOrderAssigned, $bodyOrderAssigned, $DriverData->id, $parcel->id, 'Order Assigned for Delivery');
        }

        $notificationID = 0;
        if ($parcel->parcel_type == "Service") {
            $notificationID = 20;
        } else {
            $notificationID = 3;
        }

        $CustomerData = User::where('id', $parcel->customer_id)->first();
        $notificationDriverAssigned = NotificationParcelMessage::find($notificationID);
        $deviceTokenDriverAssigned = $CustomerData->firebase_token;
        $titleDriverAssigned = $notificationDriverAssigned->title;
        $bodyDriverAssigned = str_replace('{driver_name}', ($DriverData->name ?? '') . ' ' . ($DriverData->last_name ?? ''), $notificationDriverAssigned->message);

        if (!empty($deviceTokenDriverAssigned)) {
            sendFirebaseNotification($deviceTokenDriverAssigned, $titleDriverAssigned, $bodyDriverAssigned, $parcel->customer_id, $parcel->id, 'Final destination Assigned');
        }

        // Return success response
        return response()->json([
            'message' => 'Parcel and ParcelHistory updated successfully',
            'parcel' => $parcel,
        ]);
    }

    public function statusUpdate_SignatureSelfDelivery(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable', // base64 drawn signature
            'amount' => 'nullable|numeric',
            'currency_name' => 'nullable|string',
            'created_user_id' => 'required|exists:users,id',
            'parcel_items' => 'nullable|string', // aapko json string milega, usko decode karenge
        ]);

        $imgPath = null;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/pickup_self', $filename, 'public');
            $imgPath = 'storage/' . $filePath;
        } elseif ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/pickup_self', $filename, 'public');
            $imgPath = 'storage/' . $filePath;
        }

        // Save to ParcelSignaturePickup
        ParcelSignaturePickup::create([
            'parcel_id' => $request->parcel_id,
            'notes' => $request->notes,
            'img' => $imgPath,
            'amount' => $request->amount ?? 0,
            'currency_name' => $request->currency_name ?? 'USD',
            'customer_id' => Parcel::findOrFail($request->parcel_id)->customer_id,
        ]);

        // Parcel status update
        $parcel = Parcel::findOrFail($request->parcel_id);
        $parcel->update(['status' => 11]);

        // Update ParcelInventorie status for each parcel_item id
        if ($request->parcel_items) {
            // parcel_items string aapke example me JSON string hai
            $parcelItems = json_decode($request->parcel_items, true); // ['7','8'] etc.

            if (is_array($parcelItems)) {
                ParcelInventorie::whereIn('id', $parcelItems)
                    ->update(['status' => 11]);
            }
        }

        // Parcel history
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $request->created_user_id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 11,
            'note' => $request->notes ?? null,
            'warehouse_id' => $parcel->arrived_warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE),
        ]);

        return response()->json([
            'message' => 'Signature details updated successfully.',
        ]);
    }

    public function statusUpdateAdmin_Cancel(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);
        // Update the parcel details

        if ($parcel->status == 14) {
            return response()->json([
                'status' => false,
                'message' => 'Parcel has already been canceled. Status update not allowed.',
            ], 400);
        }


        $parcel->update([
            'status' => 14,
            'warehouse_id' => $request->warehouse_id ?? null,
        ]);

        ParcelPickupDriver::where('parcel_id', $parcel->id)
            ->update(['status' => 14]);
        ParcelInventorie::where('parcel_id', $parcel->id)
            ->update(['status' => 14]);


        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $request->created_user_id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 14,
            'note' => $request->notes ?? null,
            'warehouse_id' => $request->warehouse_id ?? null,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }

    public function statusUpdateAdmin_reschedule(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
            'date' => 'required|date',
            'Re_schedule_type' => 'required|in:pickup,delivery',
        ]);



        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);

        // Prepare update data
        $updateData = [
            'status' => 23,
            'warehouse_id' => $request->warehouse_id,
        ];

        if ($request->Re_schedule_type === 'pickup') {
            $updateData['pickup_date'] = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
            //dd(Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d'));
        } elseif ($request->Re_schedule_type === 'delivery') {
            $updateData['delivery_date'] = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
        }

        // Update parcel
        $parcel->update($updateData);

        // Save to ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $request->created_user_id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 23,
            'note' => $request->notes ?? null,
            'warehouse_id' => $request->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }

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

    public function statusUpdate_self(Request $request)
    {

        // Validate the request data
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'status' => 'required',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);

        // Update the parcel details
        $parcel->update([
            'status' => $request->status,
        ]);

        ParcelInventorie::where('parcel_id', $request->parcel_id)
            ->where('container_id', $parcel->container_id)
            ->update(['status' => $request->status]);

        $parcelHistory = ParcelHistory::where('parcel_id', $request->parcel_id)->first();
        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $request->created_user_id,
            'customer_id' => $parcelHistory->customer_id,
            'status' => 'Updated',
            'parcel_status' => $request->status,
            'note' => null,
            'warehouse_id' => $parcelHistory->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return back()->with('success', 'Parcel status updated successfully.');
    }
}
