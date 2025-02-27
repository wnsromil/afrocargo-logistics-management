<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Container;
class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Container::create([
            'wearhouse_id' => 1,
            'driver_id' => 2,
            'user_id' => 3,
            'vehicle_type' => 'Container',
            'vehicle_model' => 'Model A',
            'vehicle_manufactured_year' => 2020,
            'seal_no' => '12345',
            'container_no_1' => 'C001',
            'container_no_2' => 'C002',
            'container_size' => 'Large',
            'status' => 'Active'
        ]);
        Container::create([
            'wearhouse_id' => 2,
            'driver_id' => 3,
            'user_id' => 4,
            'vehicle_type' => 'Truck',
            'vehicle_model' => 'Model B',
            'vehicle_manufactured_year' => 2019,
            'seal_no' => '54321',
            'container_no_1' => 'C003',
            'container_no_2' => 'C004',
            'container_size' => 'Medium',
            'status' => 'Inactive'
        ]);
        Container::create([
            'wearhouse_id' => 3,
            'driver_id' => 4,
            'user_id' => 5,
            'vehicle_type' => 'Van',
            'vehicle_model' => 'Model C',
            'vehicle_manufactured_year' => 2021,
            'seal_no' => '67890',
            'container_no_1' => 'C005',
            'container_no_2' => 'C006',
            'container_size' => 'Small',
            'status' => 'Active'
        ]);
    }
}
