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
        $query->where('warehouse_id', $warehouseID);

        // Optional search
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $results = $query->get();

        return response()->json([
            'data' => $results,
            'message' => 'Item get',
        ]);
    }
}
