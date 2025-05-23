<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DriverInventoriesSolde;
use Illuminate\Support\Str;

class DriverInventorySoldSeeder extends Seeder
{
    public function run(): void
    {
        $driverInventoryIds = [124, 12, 14, 84];
        $types = ['Sold'];
    
        foreach (range(1, 15) as $i) {
            $quantity = rand(1, 10);
            $price = rand(100, 500);
    
            DriverInventoriesSolde::create([
               
                'driver_inventories_id' =>  rand(1, 4),
                'driver_id'             => $driverInventoryIds[array_rand($driverInventoryIds)],
                'date'                  => now()->subDays(rand(0, 30))->format('Y-m-d'),
                'customer_id'           => rand(2, 9),
                'invoice_no'            => 'INV-' . strtoupper(Str::random(6)),
                'type'                  => $types[array_rand($types)],
                'quantity'              => $quantity,
                'price'                 => $price,
                'total'                 => $quantity * $price,
            ]);
        }
    }
    
}
