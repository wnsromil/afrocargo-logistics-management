<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Container,
    Warehouse,
    User,
    Role,
    Country,
    Vehicle,
    Parcel,
    Expense,
    ContainerHistory
};


class DashboardController extends Controller
{
    public function getDashboardStats(Request $request)
    {
        $warehouseId = $request->input('warehouse_id');

        $orderQuery = Parcel::query();

        if (!empty($warehouseId)) {
            $orderQuery->where('warehouse_id', $warehouseId);
        }

        $orderStats = $orderQuery->selectRaw('
                COUNT(*) as total_orders,
                SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as todays_orders,
                SUM(CASE WHEN status = "ready_to_ship" THEN 1 ELSE 0 END) as ready_for_shipping,
                SUM(CASE WHEN status = "in_transit" THEN 1 ELSE 0 END) as in_transit,
                SUM(CASE WHEN status = "delivered" THEN 1 ELSE 0 END) as delivered
            ')->first();

        $totalCustomers = User::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })->count();

        $newCustomers = User::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->whereDate('created_at', today())
            ->count();

        $totalDrivers = User::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('role_id', 4) // ✅ Only role_id = 4 (driver)
            ->count();


        $totalWarehouses = Warehouse::count(); // No warehouse_id filter

        $totalVehicles = Vehicle::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })->count();

        $totalEarnings = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })->sum('total_amount');

        $totalExpenses = Expense::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })->sum('amount');

        $todayEarnings = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->whereDate('created_at', today())
            ->sum('total_amount');

        $totalSupply = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('parcel_type', 'Supply')
            ->count();

        $totalDelivered = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('status', 11)
            ->count();


        $totalTransit = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('status', 5)
            ->count();


        $newSupply = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('parcel_type', 'Supply')
            ->whereDate('created_at', today())
            ->count();

        $latestContainers = Vehicle::when($warehouseId, function ($query, $warehouseId) {
            return $query->where('warehouse_id', $warehouseId);
        })
            ->where('vehicle_type', 1)
            ->withCount('parcelsCount')
            ->latest()
            ->take(4)
            ->get();

        $upcomingContainers = ContainerHistory::when($warehouseId, function ($query, $warehouseId) {
            return $query->where('arrived_warehouse_id', $warehouseId);
        })->with(['container', 'driver'])
            ->where('type', 'Arrived')
            ->where('status', 5)
            ->get();

        $totalCargo = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('transport_type', 'Ocean Cargo')
            ->where('parcel_type', 'Service')
            ->count();


        $totalAir = Parcel::when($warehouseId, function ($q) use ($warehouseId) {
            return $q->where('warehouse_id', $warehouseId);
        })
            ->where('transport_type', 'Air Cargo')
            ->where('parcel_type', 'Service')
            ->count();


        return response()->json([
            'todays_orders' => $orderStats->todays_orders,
            'total_orders' => $orderStats->total_orders,
            'ready_for_shipping' => $orderStats->ready_for_shipping,
            'in_transit' => $totalTransit,
            'delivered' => $totalDelivered,
            'total_customers' => $totalCustomers,
            'new_customers' => $newCustomers,
            'total_drivers' => $totalDrivers,
            'total_warehouses' => $totalWarehouses,
            'total_vehicles' => $totalVehicles,
            'total_earnings' => $totalEarnings,
            'today_earnings' => $todayEarnings,
            'total_supply' => $totalSupply,
            'new_supply' => $newSupply,
            'latest_containers' => $latestContainers,
            'total_Cargo' => $totalCargo,
            'total_Air' => $totalAir,
            'upcomingContainers' => $upcomingContainers,
            'totalExpenses' => $totalExpenses
        ]);
    }
}
