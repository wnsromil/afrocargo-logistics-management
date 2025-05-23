<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use \App\Models\Country;

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
            'Pending',
            'Pickup Assign',
            'Pickup Re-Schedule',
            'Received By Pickup Man',
            'Received Warehouse',
            'Transfer to Hub',
            'Received by Hub',
            'Delivery Man Assign',
            'Return to Courier',
            'Delivered',
            'Cancelled'
        ]);
        $usa = Country::where('iso3', 'USA')->get();

        // Then, get all other countries ordered by name
        $otherCountries = Country::where('iso3', '!=', 'USA')->orderBy('name', 'asc')->get();

        // Merge both collections
        $countries = $usa->merge($otherCountries);

        // Share with view
        View::share('coutry', $countries);
    }
}
