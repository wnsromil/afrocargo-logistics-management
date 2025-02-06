<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        View::share('parcelStatuses', [
            'Pending', 'Pickup Assign', 'Pickup Re-Schedule', 'Received By Pickup Man', 
            'Received Warehouse', 'Transfer to Hub', 'Received by Hub', 'Delivery Man Assign', 
            'Return to Courier', 'Delivered', 'Cancelled'
        ]);
    }
}
