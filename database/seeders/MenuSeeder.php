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
                'roles' => ['admin', 'warehouse_manager', 'driver']
            ],
            [
                'title' => 'Customers',
                'icon' => 'assets/images/Users.svg',
                'route' => 'admin.customer.index',
                'active' => 'customer*',
                'roles' => ['admin', 'warehouse_manager', 'driver']
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
               //'route' => 'admin.vehicle.index',
               'route' => '#',
                'active' => 'vehicle*,container*',
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
                'active' => 'OrderShipment*,transferHub*,receivedHub*,receivedOrders*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Invoice',
                'icon' => 'assets/images/invoices.svg',
                'route' => 'admin.invoices.index',
                'active' => 'invoices*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Notification',
                'icon' => 'assets/images/notification.svg',
                'route' => 'admin.notification.index',
                'active' => 'notification*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Advance Reports',
                'icon' => 'assets/images/reports.svg',
                'route' => 'admin.advance_reports.index',
                'active' => 'advance_reports',
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
        // Add submenus
        $orderShip = Menu::where('title', 'Order/Shipment')->first();
        if ($orderShip) {
            Menu::create([
                'title' => 'Order',
                'route' => 'admin.OrderShipment.index',
                'active' => 'OrderShipment*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
            Menu::create([
                'title' => 'Transfer To Hub',
                'route' => 'admin.transfer.hub.list',
                'active' => 'transferHub*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
            Menu::create([
                'title' => 'Container Received by Hub',
                'route' => 'admin.received.hub.list',
                'active' => 'receivedHub*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
            Menu::create([
                'title' => 'Received Orders',
                'route' => 'admin.received.orders.hub.list',
                'active' => 'receivedOrders*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
        }

        // Add submenus
        $vehicle = Menu::where('title', 'Vehicle Management')->first();
        if ($vehicle) {
            Menu::create([
                'title' => 'Vehicle List',
                'route' => 'admin.vehicle.index',
                'active' => 'vehicle*',
                'parent_id' => $vehicle->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);

            Menu::create([
                'title' => 'Container List',
                'route' => 'admin.container.list',
                'active' => 'container*',
                'parent_id' => $vehicle->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
        }
    }
}
