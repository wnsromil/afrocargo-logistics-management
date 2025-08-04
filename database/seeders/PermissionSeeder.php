<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ❗ Disable foreign key checks to avoid constraint errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the permissions table
        Permission::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $resources = [
            'dashboard' => ['view'],

            'customers' => ['view'],
            'customers_list' => ['create', 'edit', 'delete', 'show', 'account_status', 'view'],
            'ship_to_customers_list' => ['create', 'edit', 'delete', 'show', 'account_status', 'view'],

            'warehouses' => ['view'],
            'warehouse_list' => ['create', 'edit', 'delete','show', 'warehouse_status', 'view'],
            'warehouse_manager_list' => ['create', 'edit', 'delete','show', 'warehouse_manager_status', 'view'],

            'vehicle_manage' => ['create', 'edit', 'delete','show', 'vehicle_status', 'view'],
            'container_list' => ['create', 'edit', 'delete','show', 'container_status', 'view'],

            'drivers' => ['create', 'edit', 'delete','show', 'account_status', 'view'],

            'inventory' => ['view'],
            'service_inventory_list' => ['create', 'edit', 'delete','show', 'account_status', 'view'],
            'supply_inventory_list' => ['create', 'edit', 'delete','show', 'account_status', 'view'],

            'driver_inventory' => ['create', 'edit', 'delete','show', 'account_status', 'view'],

            'service_orders' => ['view'],
            'orders_list' => ['create', 'edit', 'delete','show', 'order_status', 'view','delivery','pickup'],
            'transfer_to_hub_list' => ['create', 'edit', 'delete','show', 'order_status', 'view'],
            'container_received_by_hub_list' => ['create', 'edit', 'delete','show', 'order_status', 'view'],
            'received_orders_list' => ['create', 'edit', 'delete','show', 'order_status', 'view'],

            'supply_orders' => ['create', 'edit', 'delete','show', 'supply_status', 'view'],

            'expenses' => ['create', 'edit', 'delete','show', 'status', 'view'],

            'signature_list' => ['create', 'edit', 'delete','show', 'signature_status', 'view'],

            'invoice' => ['view'],
            'invoice_list' => [
                'create', 'edit', 'delete','show', 'status', 'view',
                'invoice_pdf', 'label_pdf', 'create_label','send_invoice',
                'invoice_history', 'invoice_print','individuel_payment','claim','print','invoice_b',
                'internal_camment','comment', 'print_custom_invoice', 'tracting','notes',
                'signature_image','contract_image'
            ],
            'invoice_trash_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],

            'bill_of_landing' => ['view'],
            'bill_of_landing_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],
            'bill_of_landing_details_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],


            'custom_report' => ['view'],
            'custom_invoice_report_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],
            'verify_license_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],


            'custom_report' => ['view'],
            'custom_invoice_report_list' => [
                'create', 'edit', 'delete','show', 'status', 'view', 'print'
            ],
            'verify_license_list' => [
                'create', 'edit', 'delete','show', 'status', 'view', 'print'
            ],



            'notifications_schedule' => [
                'create', 'edit', 'delete','show', 'status', 'view'
            ],
            'role_management' => ['create', 'edit', 'delete','show', 'status', 'view'],
            'advance_reports' => ['create', 'edit', 'delete','show', 'status', 'view'],

            'template_management' => ['view'],
            'template_category_list' => ['create', 'edit', 'delete','show', 'status', 'view'],
            'template_list' => ['create', 'edit', 'delete','show', 'status', 'view'],

            'notifications' => ['delete','view'],

            'cbm_calculator' => ['view'],
            'freight_calculator_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],
            'freight_container_size_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],
            'freight_shipping_list' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],


            'delivery' => ['create', 'edit', 'delete','show', 'status', 'view', 'report'],
            'payment' => ['create', 'edit', 'delete','show', 'status', 'view'],

            'report' => ['accounting', 'end_of_day', 'invoice', 'delivery'],
            'pickup' => ['create', 'edit', 'delete','show', 'account_status', 'view'],
            'pickup_address' => ['create', 'edit', 'delete','show', 'account_status', 'view'],

        ];

        foreach ($resources as $resource => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$resource}.{$action}",
                    'guard_name' => 'web'
                ]);
            }
        }

        $this->call(\Database\Seeders\AssignAllPermissionsToUsersSeeder::class);

    }
}
