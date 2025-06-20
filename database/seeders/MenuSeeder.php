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
                'title' => 'Vehicle',
                'icon' => '<i class="menuIcon ti ti-truck-delivery"></i>',
                'route' => 'admin.vehicle.index',
                'active' => 'vehicle*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Container',
                'icon' => '<i class="menuIcon ti ti-truck-delivery"></i>',
                'route' => 'admin.container.index',
                'active' => 'container*',
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
                'title' => 'Bill of Lading',
                'icon' => '<i class="menuIcon ti ti-truck"></i>',
                'route' => 'admin.BillofLading.index',
                //  'route' => '#',
                'active' => 'bill_of_lading*,lading_details*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Notifications Schedule',
                'icon' => '<i class="menuIcon ti ti-bell-ringing"></i>',
                'route' => 'admin.notification_schedule.index',
                'active' => 'notification_schedule*',
                'roles' => ['admin']
            ],
            [
                'title' => 'Role Management',
                'icon' => '<i class="menuIcon ti ti-user-check"></i>',
                'route' => 'admin.user_role.index',
                'active' => 'user_role*',
                'roles' => ['admin']
            ],
            [
                'title' => 'Advance Reports',
                'icon' => '<i class="menuIcon ti ti-clipboard-data"></i>',
                'route' => 'admin.advance_reports.index',
                'active' => 'advance_reports*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Template Management',
                'icon' => '<i class="menuIcon ti ti-template"></i>',
                'route' => 'admin.Categorytemplate.index',
                // 'route' => '#',
                'active' => 'template_category*,templates*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Notification',
                'icon' => '<i class="menuIcon ti ti-bell-ringing"></i>',
                'route' => 'admin.notification.index',
                'active' => 'notification',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'CBM Calculator',
                'icon' => '<i class="menuIcon ti ti-truck-delivery"></i>',
                //'route' => 'admin.cbm_calculator.freight_Calculator',
                'route' => '#',
                'active' => 'cbm_calculator*',
                'roles' => ['admin', 'warehouse_manager']
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        // $inventory = Menu::where('title', 'Inventory')->first();
        // if ($inventory) {
        //     Menu::create([
        //         'title' => 'Service Inventory',
        //         'route' => 'admin.inventories.index',
        //         'active' => 'inventories*',
        //         'parent_id' => $inventory->id,
        //         'roles' => ['admin', 'warehouse_manager']
        //     ]);

        //     Menu::create([
        //         'title' => 'Supply Inventory',
        //         'route' => 'admin.supply_inventories.index',
        //         'active' => 'supply_inventories*',
        //         'parent_id' => $inventory->id,
        //         'roles' => ['admin', 'warehouse_manager']
        //     ]);
        // }
        
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
                'route' => 'admin.service_orders.index',
                'active' => 'service_orders*',
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
            // Menu::create([
            //     'title' => 'Received Orders',
            //     'route' => 'admin.received.orders.hub.list',
            //     'active' => 'receivedOrders*',
            //     'parent_id' => $orderShip->id,
            //     'roles' => ['admin', 'warehouse_manager']
            // ]);
        }

        // Add submenus
        $template = Menu::where('title', 'Template Management')->first();
        if ($template) {
            Menu::create([
                'title' => 'template Category',
                'route' => 'admin.template_category.index',
                'active' => 'template_category*',
                'parent_id' => $template->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);

            Menu::create([
                'title' => 'templates',
                'route' => 'admin.templates.index',
                'active' => 'templates*',
                'parent_id' => $template->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
        }

        // Add submenus
        $template = Menu::where('title', 'Bill Of Lading')->first();
        if ($template) {
            Menu::create([
                'title' => 'Bill Of Lading',
                'route' => 'admin.bill_of_lading.index',
                'active' => 'bill_of_lading*',
                'parent_id' => $template->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);

            Menu::create([
                'title' => 'Bill Of Lading Details',
                'route' => 'admin.lading_details.index',
                'active' => 'lading_details*',
                'parent_id' => $template->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
        }

        $cbm_calculator = Menu::where('title', 'CBM Calculator')->first();

        if ($cbm_calculator) {
            $childMenus = [
                [
                    'title' => 'Freight Calculator',
                    'route' => 'admin.cbm_calculator.freight_Calculator',
                ],
                [
                    'title' => 'Freight Container Size',
                    'route' => 'admin.cbm_calculator.freight_ContainerSize',
                ],
                [
                    'title' => 'Freight Shipping',
                    'route' => 'admin.cbm_calculator.freight_Shipping',
                ],
            ];

            foreach ($childMenus as $menu) {
                Menu::firstOrCreate(
                    ['route' => $menu['route']], // unique check by route
                    [
                        'title' => $menu['title'],
                        'active' => 'cbm_calculator*',
                        'parent_id' => $cbm_calculator->id,
                        'roles' => ['admin', 'warehouse_manager'],
                    ]
                );
            }
        }
    }
}
