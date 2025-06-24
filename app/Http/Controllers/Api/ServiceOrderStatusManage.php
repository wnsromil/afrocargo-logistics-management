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
    ParcelInventorie,
    ParcelPickupDriver
};

class ServiceOrderStatusManage extends Controller
{
    public function getDriverAllOrders(Request $request)
    {
        $percelType = $request->percel_type; // Service, Supply, all
        $date = $request->date;
        $status = $request->status;
        $search = $request->search;

        $query = Parcel::with(['pickupaddress', 'deliveryaddress', 'parcelStatus', 'customer', 'warehouse']);

        // Filter by driver type
        if ($percelType === 'Service') {
            $query->where('driver_id', $this->user->id);
        } elseif ($percelType === 'Supply') {
            $query->where('arrived_driver_id', $this->user->id);
        } elseif ($percelType === 'all') {
            $query->where(function ($q) {
                $q->where('driver_id', $this->user->id)
                    ->orWhere('arrived_driver_id', $this->user->id);
            });
        }

        // Filter by date
        if (!empty($date)) {
            if ($percelType === 'Service') {
                $query->whereDate('pickup_date', $date);
            } elseif ($percelType === 'Supply') {
                $query->whereDate('delivery_date', $date);
            } elseif ($percelType === 'all') {
                $query->where(function ($q) use ($date) {
                    $q->whereDate('pickup_date', $date)
                        ->orWhereDate('delivery_date', $date);
                });
            }
        }

        // Filter by status
        if ($status === 'pending') {
            if ($percelType === 'Service') {
                $query->where('status', 2);
            } else {
                $query->where('status', 22);
            }
        } elseif ($status === 'complete') {
            $query->where('status', 11);
        }

        // 🔍 Search filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('tracking_number', 'like', '%' . $search . '%')
                    ->orWhereHas('customer', function ($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('warehouse', function ($q3) use ($search) {
                        $q3->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('pickupaddress', function ($q4) use ($search) {
                        $q4->where('address', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('deliveryaddress', function ($q5) use ($search) {
                        $q5->where('address', 'like', '%' . $search . '%');
                    });
            });
        }

        // Fetch and map order_type
        $orders = $query->get()->map(function ($order) {
            if ($order->arrived_driver_id && $order->driver_id) {
                $order->order_type = 'Delivery';
            } elseif ($order->driver_id) {
                $order->order_type = 'Pickup';
            } elseif ($order->arrived_driver_id) {
                $order->order_type = 'Delivery';
            } else {
                $order->order_type = null;
            }
            return $order;
        });

        return response()->json([
            'status' => true,
            'status_type' => $status,
            'percel_type' => $percelType,
            'date' => $date,
            'search' => $search,
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
            'estimate_cost' => 'nullable|numeric|min:0',
            'partial_payment' => 'nullable|numeric|min:0',
            'remaining_payment' => 'nullable|numeric|min:0',
            'payment_type' => 'nullable|in:COD,Online',
        ]);

        $parcel = Parcel::findOrFail($request->parcel_id);

        if ($parcel->status == 3) {
            return response()->json([
                'status' => false,
                'message' => 'Parcel has already been picked up. Status update not allowed.',
            ], 400);
        }

        $validatedData = [
            'payment_status' => $request->remaining_payment > 0 ? 'Partial' : 'Paid',
        ];

        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 3,
            'warehouse_id' => $this->user->warehouse_id,
            // 'payment_status' => $validatedData['payment_status'],
            // 'estimate_cost' => $request->estimate_cost,
            // 'partial_payment' => $request->partial_payment,
            // 'remaining_payment' => $request->remaining_payment,
            // 'payment_type' => $request->payment_type,
        ]);

        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 3,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE),
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

        if ($parcel->status == 10) {
            return response()->json([
                'status' => false,
                'message' => 'Parcel has already been delivered. Status update not allowed.',
            ], 400);
        }



        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 10,
            // 'warehouse_id' => $this->user->warehouse_id,
        ]);


        ParcelPickupDriver::where('parcel_id', $parcel->id)
            ->where('container_id', $parcel->container_id)
            ->update(['status' => 10]);

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
            'otp' => 'required|digits:4', // ✅ Add OTP validation
            'notes' => 'nullable|string',
        ]);

        // Find the parcel by ID
        $parcel = Parcel::findOrFail($request->parcel_id);

        // ✅ Check if OTP matches
        if ($parcel->otp != $request->otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please check and try again.',
            ], 400);
        }

        // ✅ Check if already delivered
        if ($parcel->status == 11) {
            return response()->json([
                'status' => false,
                'message' => 'Parcel has already been marked as delivered. Status update not allowed.',
            ], 400);
        }

        // ✅ Update parcel
        $parcel->update([
            'driver_id' => $this->user->id,
            'status' => 11,
        ]);

        // ✅ Update ParcelPickupDriver
        ParcelPickupDriver::where('parcel_id', $parcel->id)
            ->where('container_id', $parcel->container_id)
            ->update(['status' => 11]);

        // ✅ Add Parcel History
        ParcelHistory::create([
            'parcel_id' => $parcel->id,
            'created_user_id' => $this->user->id,
            'customer_id' => $parcel->customer_id,
            'status' => 'Updated',
            'parcel_status' => 11,
            'note' => $request->notes ?? null,
            'warehouse_id' => $this->user->warehouse_id,
            'description' => json_encode($parcel, JSON_UNESCAPED_UNICODE),
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

        if ($parcel->status == 14) {
            return response()->json([
                'status' => false,
                'message' => 'Parcel has already been canceled. Status update not allowed.',
            ], 400);
        }


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

        if ($parcel->status == 23) {
            return response()->json([
                'status' => false,
                'message' => 'Parcel has already been rescheduled. Status update not allowed.',
            ], 400);
        }

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
