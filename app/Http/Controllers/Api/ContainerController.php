<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function getActiveContainers()
    {
        // Sirf active aur Container type vehicles fetch kar rahe hain
        $containers = Vehicle::where('status', 'Active')
            ->where('vehicle_type', 'Container')
            ->get();
    
        return response()->json([
            'message' => 'Active Containers fetched successfully',
            'containers' => $containers
        ]);
    }
    
}
