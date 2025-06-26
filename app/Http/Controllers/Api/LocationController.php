<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Currency;

class LocationController extends Controller
{
    public function getCountries()
    {
        return response()->json(Country::get());
    }

    public function getStates($country_id)
    {
        return response()->json(State::where('country_id', $country_id)->get());
    }

    public function getCities(Request $request, $state_id)
    {

        return response()->json(City::when(!empty($request->type) && $request->type == 'country', function ($q) use ($state_id) {
            $q->whereIn('state_id', \DB::table('states')->where('country_id', $state_id)->get()->pluck('id'));
        })->when(empty($request->type), function ($q) use ($state_id) {
            $q->where('state_id', $state_id);
        })->get());
    }

    public function getCurrencyExchangeRate(Request $request)
    {
        $currency = setting()->warehouseContries();
        return response()->json($currency);
    }
}
