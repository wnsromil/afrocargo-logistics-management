<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DriverInventoriesSolde;
use Illuminate\Support\Facades\Auth;

class DriverInventoryController extends Controller
{
    public function getDriverInventorySolde()
    {
        $driverId = auth()->id();

        $data = DriverInventoriesSolde::with(['items', 'customer'])
            ->where('driver_id', $driverId)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Driver inventory solde fetched successfully',
            'data' => $data
        ]);
    }
}
