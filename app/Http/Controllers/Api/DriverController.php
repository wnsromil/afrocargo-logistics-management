<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Vehicle,
    ContainerSize,
    DriverLog
};
use Carbon\Carbon;

class DriverController extends Controller
{
    public function getWarehouseDrivers($id)
    {
        $drivers = User::where('warehouse_id', $id)
            ->where('role_id', 4)
            ->get();

        if ($drivers->isEmpty()) {
            return response()->json([
                'message' => 'No drivers found for this warehouse',
            ], 404);
        }

        return response()->json([
            'message' => 'Drivers fetched successfully',
            'data' => $drivers
        ]);
    }

    public function getLogsByUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'from_date' => 'nullable|string',
            'to_date' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        $query = DriverLog::where('user_id', $request->user_id);

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Date range filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            try {
                $from = Carbon::parse($request->from_date);
                $to = Carbon::parse($request->to_date)->setSeconds(59); // Inclusive

                $query->whereBetween('created_at', [$from, $to]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid date format.',
                    'error' => $e->getMessage(),
                ], 422);
            }
        } else {
            // ✅ Default: get latest log and use that date
            $latestLog = DriverLog::where('user_id', $request->user_id)
                ->latest('created_at')
                ->first();

            if ($latestLog) {
                $startOfDay = Carbon::parse($latestLog->created_at)->startOfDay();
                $endOfDay = Carbon::parse($latestLog->created_at)->endOfDay();
                $query->whereBetween('created_at', [$startOfDay, $endOfDay]);
            } else {
                // If no log exists for the user
                return response()->json([
                    'status' => true,
                    'message' => 'No logs found for this user.',
                    'data' => [],
                ]);
            }
        }

        $logs = $query->orderBy('created_at', 'desc')
            ->get(['id', 'type', 'metadata', 'created_at']);

        return response()->json([
            'status' => true,
            'message' => 'Logs fetched successfully',
            'data' => $logs,
        ]);
    }
}
