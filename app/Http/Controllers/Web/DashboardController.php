<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Container,
    Warehouse,
    User,
    Role,
    Country,
    Vehicle,
    Parcel,
    ContainerHistory,
    Notification
};

class DashboardController extends Controller
{
    public function index()
    {
        // Latest 4 vehicles where type is 'Container'
        $latestContainers =  Vehicle::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->withCount('parcelsCount')
            ->latest()
            ->take(4)
            ->get();

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();


        $notification = Notification::where('status', 'Active')
            ->when($this->user->id != 1, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('notification_for', 'All')
                        ->orWhere(function ($nestedQuery) {
                            $nestedQuery->where('notification_for', 'All Warehouse Managers')
                                ->where('warehouse_id', $this->user->warehouse_id);
                        })
                        ->orWhere('user_id', $this->user->id);
                });
            })
            ->latest()
            ->first();

        $upcomingContainers = ContainerHistory::when($this->user->role_id != 1, function ($q) {
            return $q->where('arrived_warehouse_id', $this->user->warehouse_id);
        })->with(['container', 'driver'])
            ->where('type', 'Arrived')
            ->where('arrived_container', 'No')
            ->get();


        $serviceOrders = Parcel::where('parcel_type', 'Service')
            ->when(auth()->user()->role_id != 1, function ($query) {
                return $query->where('warehouse_id', auth()->user()->warehouse_id);
            })
            ->latest('id')
            ->take(10)
            ->get();

        $supplyOrders = Parcel::where('parcel_type', 'Supply')
            ->when(auth()->user()->role_id != 1, function ($query) {
                return $query->where('warehouse_id', auth()->user()->warehouse_id);
            })
            ->latest('id')
            ->take(10)
            ->get();

        return view('dashboard', compact('serviceOrders', 'notification', 'supplyOrders', 'latestContainers', 'warehouses', 'upcomingContainers'));
    }
}
