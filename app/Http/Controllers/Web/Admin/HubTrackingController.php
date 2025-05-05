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
    ParcelHistory,
    HubTracking,
    Vehicle,
    ContainerHistory
};
use Carbon\Carbon;

class HubTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function transfer_hub()
    {
        // Vehicle data
        $vehicles = Vehicle::where('vehicle_type', 'Container')
            ->where(function ($query) {
                $query->where('status', 'Active')
                    ->orWhere('container_status', 20)
                    ->orWhere('container_status', 6)
                    ->orWhere('container_status', 16);
            })
            ->withSum('parcels as partial_payment_sum', 'partial_payment')
            ->withSum('parcels as remaining_payment_sum', 'remaining_payment')
            ->withSum('parcels as total_amount_sum', 'total_amount')
            ->paginate(10);

        // ContainerHistory data
        $historyVehicles = ContainerHistory::where('type', 'Transfer')
            ->with(['container', 'driver'])
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.hubs.transfer_hub', compact('vehicles', 'historyVehicles'));
    }

    public function received_hub()
    {
        // 1. Incoming containers (status = 5 or 7 for 'Arrived')
        $incoming_containers = ContainerHistory::where('type', 'Arrived')
            ->where(function ($query) {
                $query->where('status', 5)
                    ->orWhere('status', 18);
            })
            ->orderByDesc('id')
            ->get();

        // 2. Container history (exclude status = 5 and 7 for 'Arrived')
        $container_historys = ContainerHistory::where('type', 'Arrived')
            ->where(function ($query) {
                $query->where('status', '!=', 5)
                    ->where('status', '!=', 18);
            })
            ->orderByDesc('id')
            ->get();

        return view('admin.hubs.received_hub', compact('incoming_containers', 'container_historys'));
    }



    public function received_orders()
    {
        //
        $parcels = HubTracking::when($this->user->role_id != 1, function ($q) {
            return $q->where('to_warehouse_id', $this->user->warehouse_id)->orWhere('from_warehouse_id', $this->user->warehouse_id);
        })->with(['createdByUser', 'toWarehouse', 'fromWarehouse', 'vehicle'])->withCount('parcels')->paginate(10);
        return view('admin.hubs.received_orders', compact('parcels'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $parcels = Parcel::where('hub_tracking_id', $id)->when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->latest()->paginate(10);
        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = $user->where('role_id', 4)->values();
        return view('admin.OrderShipment.index', compact('parcels', 'drivers', 'warehouses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
