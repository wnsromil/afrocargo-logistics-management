<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function getActiveContainers()
    {
        // Active containers ko fetch kar rahe hain
        $containers = Container::where('status', 'Active')->get();

        return response()->json([
            'message' => 'Active Containers fetched successfully',
            'containers' => $containers
        ]);
    }
}
