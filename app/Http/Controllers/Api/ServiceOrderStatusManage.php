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
    public function getDriverServiceOrders(Request $request)
    {
        $query = Parcel::with(['pickupaddress', 'deliveryaddress','parcelStatus'])
            ->where('driver_id', $this->user->id);

        $status = $request->status;
        $today = now()->format('Y-m-d'); // aaj ki date YYYY-MM-DD format me

        if ($status === 'pending') {
            $query->whereDate('pickup_date', $today);
        } elseif ($status === 'upcoming') {
            $query->whereDate('pickup_date', '>', $today);
        } elseif ($status === 'complete') {
            $query->where('status', 4);
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
        $order = Parcel::with(['pickupaddress', 'deliveryaddress','parcelStatus'])
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
}
