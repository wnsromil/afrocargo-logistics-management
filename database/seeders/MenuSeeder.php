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
                'title' => 'Vehicle Management',
                'icon' => 'assets/images/vehiclemangement.svg',
                //'route' => 'admin.vehicle.index',
                'route' => '#',
                'active' => 'vehicle*,container*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Drivers',
                'icon' => 'assets/images/Drivers.svg',
                'route' => 'admin.drivers.index',
                'active' => 'drivers*',
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
                'title' => 'Driver Inventory',
                'icon' => 'assets/images/driver_inventory.svg',
                'route' => 'admin.driver_inventory.index',
                'active' => 'driver_inventory*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Service Orders',
                'icon' => 'assets/images/shipment.svg',
                'route' => 'admin.service_orders.index',
                'active' => 'service_orders*,OrderShipment*,transferHub*,receivedHub*,receivedOrders*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Supply Orders',
                'icon' => 'assets/images/supply_orders@3x.svg',
                'route' => 'admin.supply_orders.index',
                'active' => 'supply_orders*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Expenses List',
                'icon' => 'assets/images/expenses.svg',
                'route' => 'admin.expenses.index',
                'active' => 'expenses*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Signature List',
                'icon' => 'assets/images/signaturelist.svg',
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
                'title' => 'Notifications Schedule',
                'icon' => 'assets/images/notification_schedule.svg',
                'route' => 'admin.notification_schedule.index',
                'active' => 'notification_schedule*',
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
                'title' => 'Role Management',
                'icon' => 'assets/images/user_role.svg',
                'route' => 'admin.user_role.index',
                'active' => 'user_role*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Advance Reports',
                'icon' => 'assets/images/reports.svg',
                'route' => 'admin.advance_reports.index',
                'active' => 'advance_reports*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Notification',
                'icon' => 'assets/images/notification.svg',
                'route' => 'admin.notification.index',
                'active' => 'notification',
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
