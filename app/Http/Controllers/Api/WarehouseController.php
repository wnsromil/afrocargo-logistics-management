<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Warehouse,
    User,
    Role,
    Country
};

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if all filters are empty
        if (collect([
            $request->warehouse_code,
            $request->address,
            $request->country_id,
            $request->state_id,
            $request->city_id
        ])->every(fn($value) => empty($value))) {
            
            // Return all active warehouses if no filters are provided
            $warehouses = Warehouse::where('status', 'Active')->get();
            return $this->sendResponse($warehouses, 'All active warehouses fetched successfully.');
        }
    
        // Filtered search
        $warehouses = Warehouse::when($request->warehouse_code, function ($q) use ($request) {
                return $q->where('warehouse_code', 'like', "%" . $request->warehouse_code . "%");
            })
            ->when($request->address, function ($q) use ($request) {
                return $q->where('address', 'like', "%" . $request->address . "%");
            })
            ->when($request->country_id, function ($q) use ($request) {
                return $q->where('country_id', $request->country_id);
            })
            ->when($request->state_id, function ($q) use ($request) {
                return $q->where('state_id', $request->state_id);
            })
            ->when($request->city_id, function ($q) use ($request) {
                return $q->where('city_id', $request->city_id);
            })
            ->get();
    
        return $this->sendResponse($warehouses, 'Warehouses fetched successfully.');
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
