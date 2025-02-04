<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use DB;
class MenuSeeder extends Seeder
{
    public function run()
    {

        if (Schema::hasTable('menus')) {
            DB::statement('TRUNCATE TABLE menus');
        }


        $menus = [
            [
                'title' => 'Dashboard', 
                'icon' => 'assets/images/dashboardlogo.svg', 
                'route' => 'admin.dashboard', 
                'active' => 'dashboard*', 
                'roles' => ['admin', 'warehouse_manager','driver']
            ],
            [
                'title' => 'Customers', 
                'icon' => 'assets/images/Users.svg', 
                'route' => 'admin.customer.index', 
                'active' => 'customer*', 
                'roles' => ['admin', 'warehouse_manager','driver']
            ],
            [
                'title' => 'Warehouse', 
                'icon' => 'assets/images/warehouse.svg', 
                'route' => '#', 
                'active' => 'warehouses*,warehouse_manager*', 
                'roles' => ['admin']
            ],
            [
                'title' => 'Drivers', 
                'icon' => 'assets/images/Drivers.svg', 
                'route' => 'admin.drivers.index', 
                'active' => 'drivers*', 
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Vehicle Management', 
                'icon' => 'assets/images/vehiclemangement.svg', 
                'route' => 'admin.vehicle.index', 
                'active' =>'vehicle*', 
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Inventory', 
                'icon' => 'assets/images/inventory.svg', 
                'route' => 'admin.inventories.index', 
                'active' => 'inventories*', 
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Order/Shipment',
                'icon' => 'assets/images/ordership.svg',
                'route' => '#',
                'active' => '',
                'roles' => ['admin', 'warehouse_manager','driver']
            ],
            [
                'title' => 'Invoice',
                'icon' => 'assets/images/invoices.svg',
                'route' => '#',
                'active' => '',
                'roles' => ['admin', 'warehouse_manager','driver']
            ],
            [
                'title' => 'Notification',
                'icon' => 'assets/images/notification.svg',
                'route' => '#',
                'active' => '',
                'roles' => ['admin', 'warehouse_manager']
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        // Add submenus
        $warehouse = Menu::where('title', 'Warehouse')->first();
        if ($warehouse) {
            Menu::create(['title' => 'Warehouse List', 'route' => 'admin.warehouses.index', 'active' => 'warehouses*', 'parent_id' => $warehouse->id, 'roles' => ['admin']]);
            Menu::create(['title' => 'Warehouse Manager', 'route' => 'admin.warehouse_manager.index', 'active' => 'warehouse_manager*', 'parent_id' => $warehouse->id, 'roles' => ['admin']]);
        }
    }
}


