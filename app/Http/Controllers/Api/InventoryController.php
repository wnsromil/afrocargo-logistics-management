<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory; // Apne model ka import karo

class InventoryController extends Controller
{
    public function getItems(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $user = $this->user;
        $warehouseID = $user->warehouse_id;

        $query = Inventory::query();

        // ✅ Filter by warehouse_id
        $query->where('warehouse_id', $warehouseID)
        ->where('status', 'Active');

        // Optional search
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Optional search
        if ($request->filled('type')) {
            if($request->type == 'Service'){
                $query->where('inventary_sub_type','!=','Supply');
            }else{
                $query->where('inventary_sub_type',$request->type);
            }

        }

        $results = $query->get();

        return response()->json([
            'data' => $results,
            'message' => 'Item get',
        ]);
    }

    public function getAllItems(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:Supply,Service',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);


        $query = Inventory::query();



        // Optional search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Optional search
        if ($request->filled('type')) {
            if($request->type == 'Service'){
                $query->where('inventary_sub_type','!=','Supply');
            }else{
                $query->where('inventary_sub_type',$request->type);
            }

        }


        $results = $query->when($request->country,function($query) use ($request){
            return $query->where('country', $request->country);
        })->when($request->state,function($query) use ($request){
            return $query->where('state', $request->state);
        })->where('status', 'Active')->get();

        return response()->json([
            'data' => $results,
            'message' => 'Item get',
        ]);
    }
}
