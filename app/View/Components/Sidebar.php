<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $items;

    public function __construct()
    {
        // Define sidebar items dynamically
        $this->items = [
            [
                'title' => 'Dashboard',
                'icon' => 'assets/images/dashboardlogo.svg',
                'route' => route('admin.dashboard'),
                'active' => request()->is('dashboard*') ? 'active' : '',
            ],
            [
                'title' => 'Customers',
                'icon' => 'assets/images/Users.svg',
                'route' => route('admin.customer.index'),
                'active' => request()->is('customer*') ? 'active' : '',
            ],
            [
                'title' => 'Warehouse',
                'icon' => 'assets/images/warehouse.svg',
                'route' => '#',
                'active' => request()->is('warehouses*') ? 'active' : '',
                'submenu' => [
                    [
                        'title' => 'Warehouse List',
                        'route' => route('admin.warehouses.index'),
                        'active' => request()->is('warehouses*') ? 'active' : '',
                    ],
                    [
                        'title' => 'Warehouse Manager',
                        'route' => '#',
                        'active' => '',
                    ]
                ],
            ],
            [
                'title' => 'Drivers',
                'icon' => 'assets/images/Drivers.svg',
                'route' => '#',
                'active' => '',
            ],
            [
                'title' => 'Vehicle Management',
                'icon' => 'assets/images/vehiclemangement.svg',
                'route' => '#',
                'active' => '',
                'submenu' => true,
            ],
            [
                'title' => 'Inventory',
                'icon' => 'assets/images/inventory.svg',
                'route' => '#',
                'active' => '',
                'submenu' => true,
            ],
            [
                'title' => 'Order/Shipment',
                'icon' => 'assets/images/ordership.svg',
                'route' => '#',
                'active' => '',
                'submenu' => true,
            ],
            [
                'title' => 'Invoice',
                'icon' => 'assets/images/invoices.svg',
                'route' => '#',
                'active' => '',
                'submenu' => true,
            ],
            [
                'title' => 'Notification',
                'icon' => 'assets/images/notification.svg',
                'route' => '#',
                'active' => '',
                'submenu' => true,
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
