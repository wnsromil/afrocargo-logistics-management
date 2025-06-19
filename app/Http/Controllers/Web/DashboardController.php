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
    ContainerHistory
};

class DashboardController extends Controller
{
    public function index()
    {
        // Latest 4 vehicles where type is 'Container'
        $latestContainers = Vehicle::where('vehicle_type', 1)
            ->withCount('parcelsCount')
            ->latest()
            ->take(4)
            ->get();

        $warehouses = Warehouse::when($this->user->role_id != 1, function ($q) {
            return $q->where('id', $this->user->warehouse_id);
        })->get();

        $upcomingContainers = ContainerHistory::when($this->user->role_id != 1, function ($q) {
            return $q->where('arrived_warehouse_id', $this->user->warehouse_id);
        })->with(['container', 'driver'])
            ->where('type', 'Arrived')
             ->where('status', 5)
            ->get();

        return view('dashboard', compact('latestContainers', 'warehouses', 'upcomingContainers'));
    }
}
