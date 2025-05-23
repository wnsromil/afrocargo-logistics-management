<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DriverInventoriesSolde;
use Illuminate\Support\Facades\Auth;

class DriverInventoryController extends Controller
{
    public function getDriverInventorySolde(Request $request)
    {
        // Get the logged-in driver's ID
        $driverId = auth()->id();
    
        // Initialize the query
        $query = DriverInventoriesSolde::with(['items.items', 'customer'])
            ->where('driver_id', $driverId);
    
        // Check if 'search' parameter is present in the request
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%'; // Add wildcards for partial matching
    
            // Apply search filter on 'invoice_no' and 'customer name'
            $query->where(function ($q) use ($searchTerm) {
                $q->where('invoice_no', 'LIKE', $searchTerm) // Search in 'invoice_no'
                  ->orWhereHas('customer', function ($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', $searchTerm); // Search in 'customer.name'
                  });
            });
        }
    
        // Execute the query and fetch the data
        $data = $query->get();
    
        // Return the response
        return response()->json([
            'status' => true,
            'message' => 'Driver inventory solde fetched successfully',
            'data' => $data
        ]);
    }
}
