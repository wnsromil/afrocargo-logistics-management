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
          //  'type' => 'nullable|in:Service,Supply',
            'search' => 'nullable|string|max:255',
        ]);

        $query = Inventory::query();

        // if ($request->filled('type')) {
        //     $query->where('inventory_type', $request->type);
        // }

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
