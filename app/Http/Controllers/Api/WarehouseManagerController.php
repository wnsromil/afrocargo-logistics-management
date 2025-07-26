<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class WarehouseManagerController extends Controller
{
    public function getWarehouseManagers($id)
    {
        $managers = User::where('warehouse_id', $id)
            ->where('role_id', 2)
            ->get();

        if ($managers->isEmpty()) {
            return response()->json([
                'message' => 'No managers found for this warehouse',
            ], 404);
        }

        return response()->json([
            'message' => 'Managers fetched successfully',
            'data' => $managers
        ]);
    }
}
