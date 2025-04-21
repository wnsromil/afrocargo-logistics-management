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
    Vehicle
};

class DashboardController extends Controller
{
    public function index()
    {
        // Latest 4 vehicles where type is 'Container'
        $latestContainers = Vehicle::where('vehicle_type', 'Container')
            ->withCount('parcelsCount')
            ->latest()
            ->take(4)
            ->get();

        return view('dashboard', compact('latestContainers'));
    }
}
