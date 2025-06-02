<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Category,
    Warehouse,
    Stock,
    Inventory,
    Parcel,
    ParcelHistory,
    Invoice,
    ParcelInventorie
};

class ServiceOrderStatusManage extends Controller
{
    public function getDriverAllOrders(Request $request)
    {
        $status = $request->status;
        $parcelType = $request->percel_type;

        // ✅ Custom date from request or fallback to today
        $inputDate = $request->input('date'); // date format expected: d-m-Y
        $filterDate = $inputDate
            ? \Carbon\Carbon::createFromFormat('d-m-Y', $inputDate)->format('Y-m-d')
            : now()->format('Y-m-d');

        $query = Parcel::with(['pickupaddress', 'deliveryaddress', 'parcelStatus', 'customer']);

        if ($parcelType === 'Service') {
            $query->where('driver_id', $this->user->id);

            if ($status === 'pending') {
                $query->whereDate('pickup_date', $filterDate);
            } elseif ($status === 'upcoming') {
                $query->whereDate('pickup_date', '>', $filterDate);
            } elseif ($status === 'complete') {
                $query->where('status', 4);
            }
        } elseif ($parcelType === 'Supply') {
            $query->where('arrived_driver_id', $this->user->id);

            if ($status === 'pending') {
                $query->whereDate('delivery_date', $filterDate);
            } elseif ($status === 'upcoming') {
                $query->whereDate('delivery_date', '>', $filterDate);
            } elseif ($status === 'complete') {
                $query->where('status', 4);
            }
        } elseif ($parcelType === 'all') {
            $query->where(function ($q) {
                $q->where('driver_id', $this->user->id)
                    ->orWhere('arrived_driver_id', $this->user->id);
            });

            if ($status === 'pending') {
                $query->where(function ($q) use ($filterDate) {
                    $q->whereDate('pickup_date', $filterDate)
                        ->orWhereDate('delivery_date', $filterDate);
                });
            } elseif ($status === 'upcoming') {
                $query->where(function ($q) use ($filterDate) {
                    $q->whereDate('pickup_date', '>', $filterDate)
                        ->orWhereDate('delivery_date', '>', $filterDate);
                });
            } elseif ($status === 'complete') {
                $query->where('status', 4);
            }
        }

        $orders = $query->get();

        return response()->json([
            'status' => true,
            'status_type' => $status,
            'message' => 'Driver service orders fetched successfully.',
            'data' => $orders
        ]);
    }

    public function getDriverServiceOrderDetails($id)
    {
        $order = Parcel::with(['pickupaddress', 'deliveryaddress', 'parcelStatus'])
            ->where('driver_id', $this->user->id)
            ->where('id', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Driver service order details fetched successfully.',
            'data' => $order
        ]);
    }

    public function statusUpdate_PickUp(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);
        // Update the parcel details
        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 3,
            'warehouse_id' => $this->user->warehouse_id,
        ]);

        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 3,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }

    public function statusUpdate_Delivery(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);
        // Update the parcel details
        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 10,
            // 'warehouse_id' => $this->user->warehouse_id,
        ]);

        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 10,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }

    public function statusUpdate_Delivered(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);
        // Update the parcel details
        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 11,
            // 'warehouse_id' => $this->user->warehouse_id,
        ]);

        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 11,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }

    public function statusUpdate_Cancel(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);
        // Update the parcel details
        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 14,
            'warehouse_id' => $this->user->warehouse_id,
        ]);

        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 14,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }

    public function statusUpdate_reschedule(Request $request)
    {
        $request->validate([
            'parcel_id' => 'required|exists:parcels,id',
            'notes' => 'nullable|string',
            'pickup_date' => 'required|date',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);
        // Update the parcel details
        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 23,
            'warehouse_id' => $this->user->warehouse_id,
            'pickup_date' => $request->pickup_date,
        ]);

        // Create a new entry in ParcelHistory
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 23,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE), // Store full request details
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Driver service order status updated successfully.',
            'data' => $parcel
        ]);
    }
}
