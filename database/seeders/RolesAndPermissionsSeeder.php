<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'warehouse_manager']);
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'driver']);
    }
}
