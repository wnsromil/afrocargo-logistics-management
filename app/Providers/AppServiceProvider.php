<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use \App\Models\Country;
use \App\Models\VehicleType;
use \App\Models\Broker;
use \App\Models\ContainerCompany;
use \App\Models\ParcelStatus;



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

        $vehicleType = VehicleType::where('status', 'Active')
            ->where('id', '!=', 1)
            ->get();

        // Then, get all other countries ordered by name
        $otherCountries = Country::where('iso3', '!=', 'USA')->orderBy('name', 'asc')->get();
        $currencies = Country::orderBy('currency', 'asc')->get()->groupBy('currency')->keys();


        // Merge both collections
        $countries = $usa->merge($otherCountries);

        $Brokers = Broker::where('status', 'Active')->get();

        $Containercompanys = ContainerCompany::where('status', 'Active')->get();

        $ParcelStatus = ParcelStatus::whereIn('type', values: ['Order', 'Comman'])->get();
        $SupplyParcelStatus = ParcelStatus::where('parcel_type', 'Comman')->get();


        // Share with view
        View::share('coutry', $countries);
        View::share('viewCurrencys', $currencies);
        View::share('viewVehicleTypes', $vehicleType);
        View::share('viewBrokers', $Brokers);
        View::share('viewVContainercompanys', $Containercompanys);
        View::share('viewParcelStatus', $ParcelStatus);
        View::share('viewSupplyParcelStatus', $SupplyParcelStatus);
    }
}
