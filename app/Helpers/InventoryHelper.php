<?php

use App\Models\DriverInventory;
use App\Models\DriverInventoriesSolde;

if (!function_exists('calculateDriverInventoryDetails')) {
    function calculateDriverInventoryDetails($driverInventoryId)
    {
        $driverInventory = DriverInventory::find($driverInventoryId);

        if (!$driverInventory) {
            return [
                'DriverInventory_quantity_total' => 0,
                'DriverInventoriesSolde_quantity' => 0,
                'remaining_quantity' => 0,
                'DriverInventory_quantity_out' => 0,
                'DriverInventory_quantity_in' => 0,
            ];
        }

        $driverId = $driverInventory->driver_id;

        // Get all related inventories for the same driver
        $relatedInventories = DriverInventory::where('driver_id', $driverId)->get();

        $DriverInventory_quantity_out = 0;
        $DriverInventory_quantity_in = 0;

        foreach ($relatedInventories as $item) {
            if ($item->in_out === 'Out') {
                $DriverInventory_quantity_out += $item->quantity ?? 0;
            } elseif ($item->in_out === 'In') {
                $DriverInventory_quantity_in += $item->quantity ?? 0;
            }
        }

        // Final inventory quantity = Out - In
        $DriverInventory_quantity_total = $DriverInventory_quantity_out - $DriverInventory_quantity_in;

        // Get all sold quantities
        $DriverInventoriesSolde_quantity = DriverInventoriesSolde::where('driver_inventories_id', $driverInventoryId)
            ->sum('quantity');

        $remaining_quantity = $DriverInventory_quantity_total - $DriverInventoriesSolde_quantity;

        return [
            'DriverInventory_quantity_total' => $DriverInventory_quantity_total,
            'DriverInventoriesSolde_quantity' => $DriverInventoriesSolde_quantity,
            'remaining_quantity' => $remaining_quantity,
            'DriverInventory_quantity_out' => $DriverInventory_quantity_out,
            'DriverInventory_quantity_in' => $DriverInventory_quantity_in,
        ];
    }
}
