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
    ContainerHistory,
    ParcelPickupDriver,
    ParcelInventorie
};
use Carbon\Carbon;

class HubTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function transfer_hub(Request $request)
    {
        $user = auth()->user(); // ya $this->user depending on your context
        $warehouseId = $user->role_id != 1 ? $user->warehouse_id : null;
        $warehouse_id = $request->input('warehouse_id');
        $fromWarehouse_id = $request->input('from_warehouse_id');
        $query = $request->search;

        // Search matching Vehicle IDs where vehicle_type = 1
        $matchedVehicleIds = collect();
        if (!empty($query)) {
            $matchedVehicleIds = Vehicle::where('vehicle_type', 1)
                ->where(function ($q) use ($query) {
                    $q->where('unique_id', 'LIKE', "%{$query}%");
                    //->orWhere('vehicle_name', 'LIKE', "%{$query}%");
                })
                ->pluck('id');
        }

        // Get list of warehouses
        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->select('id', 'warehouse_name')
            ->get();

        // Vehicle data from ContainerHistory
        $vehicles = ContainerHistory::where('arrived_container', 'No')
            ->when($warehouseId, function ($query, $warehouseId) {
                return $query->where('warehouse_id', $warehouseId);
            })
            ->whereIn('type', ['Transfer', 'Active'])
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
            })
            ->when($fromWarehouse_id, function ($q) use ($fromWarehouse_id) {
                return $q->where('arrived_warehouse_id', $fromWarehouse_id);
            })
            ->when($query, function ($q) use ($matchedVehicleIds) {
                return $q->whereIn('container_id', $matchedVehicleIds);
            })
            ->with(['container', 'driver'])
            ->orderBy('id', 'desc')
            ->get();

        // History Vehicles from ContainerHistory
        $historyVehicles = ContainerHistory::where('arrived_container', 'Yes')
            ->where('type', 'Transfer')
            ->when($warehouseId, function ($query, $warehouseId) {
                return $query->where('warehouse_id', $warehouseId);
            })
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
            })
            ->when($fromWarehouse_id, function ($q) use ($fromWarehouse_id) {
                return $q->where('arrived_warehouse_id', $fromWarehouse_id);
            })
            ->when($query, function ($q) use ($matchedVehicleIds) {
                return $q->whereIn('container_id', $matchedVehicleIds);
            })
            ->with(['container', 'driver'])
            ->orderBy('id', 'desc')
            ->get();

        // Get all warehouses again for dropdown
        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        return view('admin.hubs.transfer_hub', compact('vehicles', 'historyVehicles', 'warehouses'));
    }

    public function received_hub(Request $request)
    {
        $user = auth()->user(); // ya $this->user depending on your context
        $warehouseId = $user->role_id != 1 ? $user->warehouse_id : null;
        $warehouse_id = $request->input('warehouse_id');
        $fromWarehouse_id = $request->input('from_warehouse_id');
        $query = $request->search;

        // Search matching Vehicle IDs where vehicle_type = 1
        $matchedVehicleIds = collect();
        if (!empty($query)) {
            $matchedVehicleIds = Vehicle::where('vehicle_type', 1)
                ->where(function ($q) use ($query) {
                    $q->where('unique_id', 'LIKE', "%{$query}%");
                    //->orWhere('vehicle_name', 'LIKE', "%{$query}%");
                })
                ->pluck('id');
        }

        // Get list of warehouses
        $warehouses = Warehouse::where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('id', $this->user->warehouse_id);
            })
            ->select('id', 'warehouse_name')
            ->get();

        // 1. Incoming containers (status = 5 or 7 for 'Arrived')
        $incoming_containers = ContainerHistory::whereIn('arrived_container', ['No', 'Yes'])
            ->when($warehouseId, function ($query, $warehouseId) {
                return $query->where('arrived_warehouse_id', $warehouseId);
            })
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
            })
            ->when($fromWarehouse_id, function ($q) use ($fromWarehouse_id) {
                return $q->where('arrived_warehouse_id', $fromWarehouse_id);
            })
            ->when($query, function ($q) use ($matchedVehicleIds) {
                return $q->whereIn('container_id', $matchedVehicleIds);
            })
            ->where('type', 'Arrived')
            ->where('full_discharge', 'No')
            ->with(['container', 'driver'])
            ->orderBy('id', 'desc')
            ->get();



        // 2. Container history (exclude status = 5 and 7 for 'Arrived')
        $container_historys = ContainerHistory::where('full_discharge', 'Yes')->where('type', 'Arrived')
            ->when($warehouseId, function ($query, $warehouseId) {
                return $query->where('arrived_warehouse_id', $warehouseId);
            })
            ->when($warehouse_id, function ($q) use ($warehouse_id) {
                return $q->where('warehouse_id', $warehouse_id);
            })
            ->when($fromWarehouse_id, function ($q) use ($fromWarehouse_id) {
                return $q->where('arrived_warehouse_id', $fromWarehouse_id);
            })
            ->when($query, function ($q) use ($matchedVehicleIds) {
                return $q->whereIn('container_id', $matchedVehicleIds);
            })
            ->with(['container', 'driver'])
            ->orderBy('id', 'desc')
            ->get();


        return view('admin.hubs.received_hub', compact('incoming_containers', 'warehouses', 'container_historys'));
    }

    public function received_orders(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);
        $driver_id = $request->input('driver_id');
        $shipping_type = $request->input('shipping_type');
        $status_search = $request->input('status_search');
        $daysPickupType = $request->input('days_pickup_type'); // <-- NEW
        $warehouse_id = $request->input('warehouse_id');

        $query = Parcel::where('parcel_type', 'Service')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('arrived_warehouse_id', $this->user->warehouse_id);
            })
            ->when($warehouse_id, fn($q) => $q->where('arrived_warehouse_id', $warehouse_id))
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('tracking_number', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%")
                        ->orWhere('estimate_cost', 'LIKE', "%$search%")
                        ->orWhere('total_amount', 'LIKE', "%$search%");

                    if (\DateTime::createFromFormat('d-m-Y', $search) !== false) {
                        $formattedDate = \DateTime::createFromFormat('d-m-Y', $search)->format('Y-m-d');
                        $query->orWhereDate('pickup_date', '=', $formattedDate);
                    }
                });
            })
            ->when($driver_id, fn($q) => $q->where('driver_id', $driver_id))
            ->when($shipping_type, fn($q) => $q->where('transport_type', $shipping_type))
            ->when($status_search, fn($q) => $q->where('status', $status_search))

            // ✅ Filter by pickup day
            ->when($daysPickupType, function ($q) use ($daysPickupType) {
                $today = now()->toDateString();
                $yesterday = now()->subDay()->toDateString();
                $tomorrow = now()->addDay()->toDateString();

                return $q->when($daysPickupType === 'Yesterdays_pickups', fn($q) => $q->whereDate('pickup_date', $yesterday))
                    ->when($daysPickupType === 'Today_pickups', fn($q) => $q->whereDate('pickup_date', $today))
                    ->when($daysPickupType === 'Tomorrows_pickup', fn($q) => $q->whereDate('pickup_date', $tomorrow));
            })

            ->latest('id');

        $parcels = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage,
            'driver_id' => $driver_id,
            'shipping_type' => $shipping_type,
            'status_search' => $status_search,
            'days_pickup_type' => $daysPickupType,
        ]);

        $serialStart = ($currentPage - 1) * $perPage;

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = User::where('role_id', 4)
            ->where('status', 'Active')
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.hubs.received_table_orders', compact(
                'parcels',
                'drivers',
                'warehouses',
                'search',
                'perPage',
                'serialStart',
                'daysPickupType'
            ))->render();
        }

        return view('admin.hubs.received_orders', compact(
            'parcels',
            'drivers',
            'warehouses',
            'search',
            'perPage',
            'serialStart',
            'daysPickupType' // optional: if you want to use this in blade
        ));
    }

    public function received_orders_show(Request $request, $id)
    {

        //
        $ParcelHistories = ParcelHistory::where('parcel_id', $id)
            ->with(['warehouse', 'customer', 'createdByUser'])->get();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        $parcel = Parcel::when($this->user->role_id != 1, function ($q) {
            return $q->where('arrived_warehouse_id', $this->user->warehouse_id);
        })->where('id', $id)->first();

        $parcelItems = ParcelPickupDriver::where('parcel_id', $id)->get();

        return view('admin.service_orders.orderdetails', compact('parcelItems', 'ParcelHistories', 'parcelTpyes', 'parcel'));
    }

    public function container_order(Request $request, $id, $type)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $parcels = Parcel::where('parcel_type', 'Service')
            ->when($type === 'Arrived', function ($q) use ($id) {
                return $q->where('arrived_container_history_id', $id);
            })
            ->when($type === 'Transfer', function ($q) use ($id) {
                return $q->where('container_history_id', $id);
            })
            ->when($type === 'OnLoading', function ($q) use ($id) {
                return $q->where('container_history_id', $id);
            })
            ->when($this->user->role_id != 1, function ($q) {
                return $q->where('warehouse_id', $this->user->warehouse_id);
            })
            ->when($search, function ($q) use ($search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('tracking_number', 'LIKE', "%$search%")
                        ->orWhere('status', 'LIKE', "%$search%")
                        ->orWhere('estimate_cost', 'LIKE', "%$search%")
                        ->orWhere('total_amount', 'LIKE', "%$search%");

                    if (\DateTime::createFromFormat('d-m-Y', $search) !== false) {
                        $formattedDate = \DateTime::createFromFormat('d-m-Y', $search)->format('Y-m-d');
                        $query->orWhereDate('pickup_date', '=', $formattedDate);
                    }
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);

        $serialStart = ($currentPage - 1) * $perPage;

        $user = collect(User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->get());

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $drivers = $user->where('role_id', 4)->values();

        if ($request->ajax()) {
            return view('admin.hubs.orderlist_table', compact('parcels', 'serialStart'))->render();
        }

        return view('admin.hubs.orderlist', compact('parcels', 'drivers', 'warehouses', 'search', 'perPage', 'serialStart'));
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
        $ParcelHistories = ParcelHistory::where('parcel_id', $id)
            ->with(['warehouse', 'customer', 'createdByUser'])->get();

        $parcelTpyes = Category::whereIn('name', ['box', 'bag', 'barrel'])->get();

        $parcel = Parcel::where('id', $id)->first();

        $parcelItems = ParcelInventorie::where('parcel_id', $id)->get();

        return view('admin.hubs.orderdetails', compact('parcelItems', 'ParcelHistories', 'parcelTpyes', 'parcel'));
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
