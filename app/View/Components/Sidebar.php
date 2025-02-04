<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class Sidebar extends Component
{
    public $items;
    public $menus;

    public function __construct()
    {
        $userRole = auth()->user()->role; // Assuming role is stored in the `users` table

        $this->menus = Menu::whereNull('parent_id')
            ->whereJsonContains('roles', $userRole) // Only get menus matching the user's role
            ->with(['submenu' => function ($query) use ($userRole) {
                $query->whereJsonContains('roles', $userRole);
            }])
            ->orderBy('order')
            ->get();
        // Define sidebar items dynamically
        // $this->items = [
        //     [
        //         'title' => 'Dashboard',
        //         'icon' => 'assets/images/dashboardlogo.svg',
        //         'route' => 'admin.dashboard',
        //         'active' => 'dashboard*',
        //     ],
        //     [
        //         'title' => 'Customers',
        //         'icon' => 'assets/images/Users.svg',
        //         'route' => 'admin.customer.index',
        //         'active' => 'customer*',
        //     ],
        //     [
        //         'title' => 'Warehouse',
        //         'icon' => 'assets/images/warehouse.svg',
        //         'route' => '#',
        //         'active' => ['warehouses*','warehouse_manager*'],
        //         'submenu' => [
        //             [
        //                 'title' => 'Warehouse List',
        //                 'route' => 'admin.warehouses.index',
        //                 'active' => 'warehouses*',
        //             ],
        //             [
        //                 'title' => 'Warehouse Manager',
        //                 'route' => 'admin.warehouse_manager.index',
        //                 'active' => 'warehouse_manager*',
        //             ]
        //         ],
        //     ],
        //     [
        //         'title' => 'Drivers',
        //         'icon' => 'assets/images/Drivers.svg',
        //         'route' => 'admin.drivers.index',
        //         'active' => 'drivers*',
        //     ],
        //     [
        //         'title' => 'Vehicle Management',
        //         'icon' => 'assets/images/vehiclemangement.svg',
        //         'route' => 'admin.vehicle.index',
        //         'active' =>'vehicle*',
        //         'submenu' => true,
        //     ],
        //     [
        //         'title' => 'Inventory',
        //         'icon' => 'assets/images/inventory.svg',
        //         'route' => 'admin.inventories.index',
        //         'active' => 'inventories*',
        //     ],
        //     [
        //         'title' => 'Order/Shipment',
        //         'icon' => 'assets/images/ordership.svg',
        //         'route' => '#',
        //         'active' => '',
        //         'submenu' => true,
        //     ],
        //     [
        //         'title' => 'Invoice',
        //         'icon' => 'assets/images/invoices.svg',
        //         'route' => '#',
        //         'active' => '',
        //         'submenu' => true,
        //     ],
        //     [
        //         'title' => 'Notification',
        //         'icon' => 'assets/images/notification.svg',
        //         'route' => '#',
        //         'active' => '',
        //         'submenu' => true,
        //     ],
        // ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
