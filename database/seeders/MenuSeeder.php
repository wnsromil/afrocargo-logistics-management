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
                'roles' => ['admin', 'warehouse_manager', 'driver'],
                'permissions' => ['dashboard.view'],
            ],
            [
                'title' => 'Customers',
                'icon' => '<i class="menuIcon ti ti-users"></i>',
                'route' => 'admin.customer.index',
                'active' => 'customer*,customer-shipTo',
                'roles' => ['admin', 'warehouse_manager', 'driver'],
                //'permissions' => ['customers.view'],
            ],
            [
                'title' => 'Warehouses',
                'icon' => '<i class="menuIcon ti ti-building-warehouse"></i>',
                'route' => '#',
                'active' => 'warehouses*,warehouse_manager*',
                'roles' => ['admin'],
                'permissions' => ['warehouses.view'],
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
                'icon' => '<img src="https://afrocargo.senomicsecurity.in/public/assets/images/container_icon.svg" alt="Container Icon" class="menuIcon">',
                'route' => 'admin.container.index',
                'active' => 'container*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Drivers',
                'icon' => '<i class="menuIcon ti ti-forklift"></i>',
                'route' => 'admin.drivers.index',
                'active' => 'drivers*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['drivers.view'],
            ],
            [
                'title' => 'Inventory',
                'icon' => '<i class="menuIcon ti ti-brand-unsplash"></i>',
                'route' => 'admin.inventories.index',
                'active' => 'inventories*,supply_inventories*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['inventory.view'],
            ],
            [
                'title' => 'Driver Inventory',
                'icon' => '<i class="menuIcon ti ti-truck-loading"></i>',
                'route' => 'admin.driver_inventory.index',
                'active' => 'driver_inventory*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['driver_inventory.view'],
            ],
            [
                'title' => 'Service Orders',
                'icon' => '<i class="menuIcon ti ti-packages"></i>',
                'route' => 'admin.service_orders.index',
                'active' => 'service_orders*,OrderShipment*,transferHub*,receivedHub*,receivedOrders*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['service_orders.view'],
            ],
            [
                'title' => 'Supply Orders',
                'icon' => '<i class="menuIcon ti ti-cube-send"></i>',
                'route' => 'admin.supply_orders.index',
                'active' => 'supply_orders*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['supply_orders.view'],
            ],
            [
                'title' => 'Expenses List',
                'icon' => '<i class="menuIcon ti ti-businessplan"></i>',
                'route' => 'admin.expenses.index',
                'active' => 'expenses*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['expenses.view'],
            ],
            [
                'title' => 'Signature List',
                'icon' => '<i class="menuIcon ti ti-clipboard-list"></i>',
                'route' => 'admin.signature.index',
                'active' => 'signature*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['signature_list.view'],
            ],
            [
                'title' => 'Invoice',
                'icon' => '<i class="menuIcon ti ti-file-dollar"></i>',
                'route' => 'admin.invoices.index',
                'active' => 'invoices*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['invoice.view'],
            ],
            [
                'title' => 'Bill of Lading',
                'icon' => '<i class="menuIcon ti ti-truck"></i>',
                'route' => 'admin.BillofLading.index',
                // 'route' => '#',
                'active' => 'bill_of_lading*,lading_details*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Custom Reports',
                'icon' => '<i class="ti ti-chart-sankey"></i>',
                'route' => '#',
                'active' => 'custom-reports*,verify-license*',
                'roles' => ['admin', 'warehouse_manager']
            ],
            [
                'title' => 'Notifications Schedule',
                'icon' => '<i class="menuIcon ti ti-bell-ringing"></i>',
                'route' => 'admin.notification_schedule.index',
                'active' => 'notification_schedule*',
                'roles' => ['admin'],
                'permissions' => ['notifications_schedule.view'],
            ],
            [
                'title' => 'Role Management',
                'icon' => '<i class="menuIcon ti ti-user-check"></i>',
                'route' => 'admin.user_role.index',
                'active' => 'user_role*',
                'roles' => ['admin'],
                'permissions' => ['role_management.view'],
            ],
            [
                'title' => 'Advance Reports',
                'icon' => '<i class="menuIcon ti ti-clipboard-data"></i>',
                'route' => 'admin.advance_reports.index',
                'active' => 'advance_reports*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['advance_reports.view'],
            ],
            [
                'title' => 'Template Management',
                'icon' => '<i class="menuIcon ti ti-template"></i>',
                'route' => 'admin.Categorytemplate.index',
                // 'route' => '#',
                'active' => 'template_category*,templates*',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['template_management.view'],
            ],
            [
                'title' => 'Notification',
                'icon' => '<i class="menuIcon ti ti-bell-ringing"></i>',
                'route' => 'admin.notification.index',
                'active' => 'notification',
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['notification.view'],
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
            // Convert permissions array to JSON string or NULL before save if your DB field is JSON or TEXT
            // if (isset($menu['permissions']) && is_array($menu['permissions'])) {
            //     $menu['permissions'] = json_encode($menu['permissions']);
            // }

            Menu::create($menu);
        }

        $customer = Menu::where('title', 'Customers')->first();
        if ($customer) {
            Menu::create([
                'title' => 'Customers',
                'route' => 'admin.customer.index',
                'active' => 'customer',
                'parent_id' => $customer->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);

            Menu::create([
                'title' => 'Ship To Customers',
                'route' => 'admin.customer.shipToIndex',
                'active' => 'customer-shipTo',
                'parent_id' => $customer->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
        }

        $inventory = Menu::where('title', 'Inventory')->first();
        if ($inventory) {
            Menu::create([
                'title' => 'Service Inventory',
                'route' => 'admin.inventories.index',
                'active' => 'inventories*',
                'parent_id' => $inventory->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);

            Menu::create([
                'title' => 'Supply Inventory',
                'route' => 'admin.supply_inventories.index',
                'active' => 'supply_inventories*',
                'parent_id' => $inventory->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
        }

        // Add submenus
        $warehouse = Menu::where('title', 'Warehouses')->first();
        if ($warehouse) {
            Menu::create(['title' => 'Warehouse List', 'route' => 'admin.warehouses.index', 'active' => 'warehouses*', 'parent_id' => $warehouse->id, 'roles' => ['admin']]);
            Menu::create(['title' => 'Warehouse Manager', 'route' => 'admin.warehouse_manager.index', 'active' => 'warehouse_manager*', 'parent_id' => $warehouse->id, 'roles' => ['admin']]);
        }

        $CustomReports = Menu::where('title', 'Custom Reports')->first();
        if ($CustomReports) {
            Menu::create(['title' => 'Custom Invoice Reports', 'route' => 'admin.custom-reports.index', 'active' => 'custom-reports*', 'parent_id' => $CustomReports->id, 'roles' => ['admin', 'warehouse_manager']]);
            Menu::create(['title' => 'Verify License', 'route' => 'admin.verify-license.index', 'active' => 'verify-license*', 'parent_id' => $CustomReports->id, 'roles' => ['admin', 'warehouse_manager']]);
        }
        // Add submenus
        $orderShip = Menu::where('title', 'Service Orders')->first();
        if ($orderShip) {
            Menu::create([
                'title' => 'Order',
                'route' => 'admin.service_orders.index',
                'active' => 'service_orders*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['order.view'],
            ]);
            Menu::create([
                'title' => 'Received Order',
                'route' => 'admin.received.orders.hub.list',
                'active' => 'receivedOrders*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);
            Menu::create([
                'title' => 'Transfer To Hub',
                'route' => 'admin.transfer.hub.list',
                'active' => 'transferHub*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['transfer_to_hub.view'],
            ]);
            Menu::create([
                'title' => 'Container Received by Hub',
                'route' => 'admin.received.hub.list',
                'active' => 'receivedHub*',
                'parent_id' => $orderShip->id,
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['container_received_by_hub.view'],
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
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['template_category.view'],
            ]);

            Menu::create([
                'title' => 'templates',
                'route' => 'admin.templates.index',
                'active' => 'templates*',
                'parent_id' => $template->id,
                'roles' => ['admin', 'warehouse_manager'],
                'permissions' => ['template.view'],
            ]);
        }

        // Add submenus Bill Of Lading
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

        // Add submenus Invoice
        $template = Menu::where('title', 'Invoice')->first();
        if ($template) {
            Menu::create([
                'title' => 'Invoice',
                'route' => 'admin.invoices.index',
                'active' => 'invoices',
                'parent_id' => $template->id,
                'roles' => ['admin', 'warehouse_manager']
            ]);

            Menu::create([
                'title' => 'Trashed Invoice',
                'route' => 'admin.invoice.trashed',
                'active' => 'invoices/trashed/list',
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
