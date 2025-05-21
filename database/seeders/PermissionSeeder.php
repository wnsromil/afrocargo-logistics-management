<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $resources = [
            'dashboard' => ['view'],
            'customers' => ['create', 'edit', 'delete', 'show', 'account_status', 'view'],
            'warehouses' => ['view'],
            'warehouse' => ['create', 'edit', 'delete','show', 'warehouse_status', 'view'],
            'warehouse_manager' => ['create', 'edit', 'delete','show', 'warehouse_manager_status', 'view'],

            'vehicle_manage' => ['view'],
            'container_list' => ['create', 'edit', 'delete','show', 'container_status', 'view'],
            'vehicle_list' => ['create', 'edit', 'delete','show', 'vehicle_status', 'view'],

            'drivers' => ['create', 'edit', 'delete','show', 'account_status', 'view'],
            'inventory' => ['create', 'edit', 'delete','show', 'account_status', 'view'],
            'driver_inventory' => ['create', 'edit', 'delete','show', 'account_status', 'view'],

            'service_orders' => ['view'],
            'orders' => ['create', 'edit', 'delete','show', 'order_status', 'view'],
            'transfer_to_hub' => ['create', 'edit', 'delete','show', 'order_status', 'view'],
            'container_received_by_hub' => ['create', 'edit', 'delete','show', 'order_status', 'view'],
            'received_orders' => ['create', 'edit', 'delete','show', 'order_status', 'view'],

            'supply_orders' => ['create', 'edit', 'delete','show', 'supply_status', 'view'],

            'expenses' => ['create', 'edit', 'delete','show', 'status', 'view'],
            'signature_list' => ['create', 'edit', 'delete','show', 'signature_status', 'view'],
            'invoice' => ['create', 'edit', 'delete','show', 'status', 'view', 'print'],
            'notifications_schedule' => ['create', 'edit', 'delete','show', 'status', 'view'],
            'role_management' => ['create', 'edit', 'delete','show', 'status', 'view'],
            'advance_reports' => ['create', 'edit', 'delete','show', 'status', 'view'],

            'template_management' => ['view'],
            'template_category' => ['create', 'edit', 'delete','show', 'status', 'view'],
            'template' => ['create', 'edit', 'delete','show', 'status', 'view'],


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
    }
}