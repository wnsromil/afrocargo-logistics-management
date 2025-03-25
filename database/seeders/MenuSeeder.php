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
                'icon' => '<i class="menuIcon ti ti-layout-dashboard"></i>',
                'route' => 'admin.dashboard',
                'active' => 'dashboard*',
                'roles' => ['admin', 'warehouse_manager', 'driver']
            ],
            [
                'title' => 'Customers',
                'icon' => '<i class="menuIcon ti ti-users"></i>',
                'route' => 'admin.customer.index',
                'active' => 'customer*',
                'roles' => ['admin', 'warehouse_manager', 'driver']
            ],
            [
                'title' => 'Warehouses',
                'icon' => '<i class="menuIcon ti ti-building-warehouse"></i>',
                'route' => '#',
                'active' => 'warehouses*,warehouse_manager*',
                'roles' => ['admin']
            ],
            [
                'title' => 'Vehicle Management',
                'icon' => '<i class="menuIcon ti ti-truck-delivery"></i>',
                //'route' => 'admin.vehicle.index',
                'route' => '#',
                'active' => 'vehicle*,container*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Drivers',
                'icon' => '<i class="menuIcon ti ti-forklift"></i>',
                'route' => 'admin.drivers.index',
                'active' => 'drivers*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Inventory',
                'icon' => '<i class="menuIcon ti ti-brand-unsplash"></i>',
                'route' => 'admin.inventories.index',
                'active' => 'inventories*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Driver Inventory',
                'icon' => '<i class="menuIcon ti ti-truck-loading"></i>',
                'route' => 'admin.driver_inventory.index',
                'active' => 'driver_inventory*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Service Orders',
                'icon' => '<i class="menuIcon ti ti-packages"></i>',
                'route' => 'admin.service_orders.index',
                'active' => 'service_orders*,OrderShipment*,transferHub*,receivedHub*,receivedOrders*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Supply Orders',
                'icon' => '<i class="menuIcon ti ti-cube-send"></i>',
                'route' => 'admin.supply_orders.index',
                'active' => 'supply_orders*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Expenses List',
                'icon' => '<i class="menuIcon ti ti-businessplan"></i>',
                'route' => 'admin.expenses.index',
                'active' => 'expenses*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Signature List',
                'icon' => '<i class="menuIcon ti ti-clipboard-list"></i>',
                'route' => 'admin.signature.index',
                'active' => 'signature*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            // [
            //     'title' => 'Order/Shipment',
            //     'icon' => 'assets/images/ordership.svg',
            //     'route' => '#',
            //     'active' => 'OrderShipment*,transferHub*,receivedHub*,receivedOrders*',
            //     'roles' => ['admin', 'warehouse_manager']
            // ],
            [
                'title' => 'Invoice',
                'icon' => '<i class="menuIcon ti ti-file-dollar"></i>',
                'route' => 'admin.invoices.index',
                'active' => 'invoices*',
                'roles' => ['admin', 'warehouse_manager']
            ], 
            [
                'title' => 'Notifications Schedule',
                'icon' => '<i class="menuIcon ti ti-bell-ringing"></i>',
                'route' => 'admin.notification_schedule.index',
                'active' => 'notification_schedule*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Role Management',
                'icon' => '<i class="menuIcon ti ti-user-check"></i>',
                'route' => 'admin.user_role.index',
                'active' => 'user_role*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Advance Reports',
                'icon' => '<i class="menuIcon ti ti-clipboard-data"></i>',
                'route' => 'admin.advance_reports.index',
                'active' => 'advance_reports*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Notification',
                'icon' => '<i class="menuIcon ti ti-bell-ringing"></i>',
                'route' => 'admin.notification.index',
                'active' => 'notification',
                'roles' => ['admin', 'warehouse_manager']
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        // Add submenus
        $warehouse = Menu::where('title', 'Warehouses')->first();
        if ($warehouse) {
            Menu::create(['title' => 'Warehouse List', 'route' => 'admin.warehouses.index', 'active' => 'warehouses*', 'parent_id' => $warehouse->id, 'roles' => ['admin']]);
            Menu::create(['title' => 'Warehouse Manager', 'route' => 'admin.warehouse_manager.index', 'active' => 'warehouse_manager*', 'parent_id' => $warehouse->id, 'roles' => ['admin']]);
        }
        // Add submenus
        $orderShip = Menu::where('title', 'Service Orders')->first();
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
