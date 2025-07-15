<?php

namespace App\Helpers;

use App\Models\{
    Setting,
    ParcelStatus,
    Warehouse,
    Country,
    LocationSchedule,
    WeeklySchedule,
};
use Carbon\Carbon;

class SettingsHelper
{
    public static function get($key = null, $default = null)
    {
        // Try to get project-specific setting
        $setting = Setting::where('key', $key)->first();

        // Return setting value or default
        return $setting ? self::formatValue($setting->type, $setting->value) : $default;
    }

    public static function getAll()
    {
        // Return setting value or default
        return Setting::get();
    }

    public static function set($key, $value, $type = 'string', $defaultValue = null)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'type' => $type, 'default_value' => $defaultValue]
        );
    }

    public static function setGlobal($key, $value, $type = 'string', $defaultValue = null)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'type' => $type, 'default_value' => $defaultValue]
        );
    }

    public static function statusList()
    {
        return ParcelStatus::get();
    }

    public static function warehouseContries()
    {
        // Get unique country names from warehouses and convert to lowercase, with warehouse ids
        $warehouses = Warehouse::select('id', 'country_id')
        ->where('status', 'Active')
            ->get()
            ->groupBy(function ($item) {
                return strtolower($item->country_id);
            });

        $countryNames = $warehouses->keys();

        // Get countries where LOWER(name) matches any lowercase country_id
        $countries = Country::whereRaw('LOWER(name) IN ("' . $countryNames->implode('","') . '")')
            ->select('id', 'name', 'iso2', 'iso3', 'phonecode', 'currency', 'currency_symbol')
            ->get();

        // Attach warehouse ids to each country
        foreach ($countries as $country) {
            $key = strtolower($country->name);
            $country->warehouse_ids = $warehouses->has($key)
                ? $warehouses[$key]->pluck('id')->values()
                : collect();
        }

        return $countries;
    }

    public static function ActiveWarehouseContries()
    {


        // Get countries where LOWER(name) matches any lowercase country_id
        return Warehouse::leftJoin('countries', 'warehouses.country_id', '=', 'countries.name')
            ->where('warehouses.status', 'Active')
            ->select('warehouses.*', 'countries.id as countryId','countries.name', 'countries.iso2', 'countries.iso3', 'countries.phonecode', 'countries.currency', 'countries.currency_symbol')
            ->get();
    }
    

    public static function getNearbyWarehouseDriverIds($lat, $lng, $radius = 50)
    {
        return LocationSchedule::select('user_id')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$lat, $lng, $lat]
            )
            ->having('distance', '<=', $radius)
            ->pluck('user_id');
    }

    public static function getDriverTimeSlot($userIds, $dayName = null)
    {
        // If $dayName is null or empty, use current day name in lowercase
        if (empty($dayName)) {
            $dayName = strtolower(Carbon::now()->format('l'));
        }

        // $userIds = self::getNearbyWarehouseDriverIds($lat, $long);

        foreach ($userIds as $userId) {
            $availablePeriods = [];

            // Step 1: Check availability table se user ki entry
            if (isset($availabilities[$userId])) {
                $avail = $availabilities[$userId];
                foreach (['morning', 'afternoon', 'evening'] as $period) {
                    if ($avail->$period == 1) {
                        $availablePeriods[] = $period;
                    }
                }

                // Agar koi period 1 nahi mila, skip this user
                if (empty($availablePeriods)) {
                    continue;
                }
            } else {
                // Step 2: availability record nahi mila => sab periods maan lo
                $availablePeriods = ['morning', 'afternoon', 'evening'];
            }
        
            // Step 3: Weekly schedule nikaalo
            $weekly = WeeklySchedule::where('user_id', $userId)
                ->where('day', $dayName)
                ->first();

            if (!$weekly) continue;

            // Step 4: time slots banao
            foreach ($availablePeriods as $period) {
                $startField = $period . '_start';
                $endField = $period . '_end';

                if ($weekly->$startField && $weekly->$endField) {
                    $start = Carbon::parse($weekly->$startField);
                    $end = Carbon::parse($weekly->$endField);

                    $current = $start->copy();
                    while ($current->lt($end)) {
                        $next = $current->copy()->addHour();
                        if ($next->gt($end)) break;

                        $slot = $current->format('h:i A') . ' - ' . $next->format('h:i A');
                        $slotsSet[$period][$slot] = true;

                        $current = $next;
                    }
                }
            }
        }

        // Final formatting
        $finalSlots = [];
        foreach (['morning', 'afternoon', 'evening'] as $period) {
            $finalSlots[$period] = isset($slotsSet[$period])
                ? array_keys($slotsSet[$period])
                : [];
        }

        return $finalSlots;
    }

    public static function getLatLngFromLocation($country = '', $state = '', $city = '')
    {
        try {
            //code...
        
            $apiKey = 'AIzaSyCJFnhTgQa7v75t28FbMgajOv-5mJuMTqI&libraries'; // replace with your actual API key

            // Build the address string
            $addressParts = array_filter([$city, $state, $country]);
            $address = implode(',', $addressParts);
            // dd($address);
            // URL encode the address
            $encodedAddress = urlencode($address);

            // Construct the API URL
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedAddress}&key={$apiKey}";

            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            // Get response
            $response = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response
            $responseData = json_decode($response, true);

            // Check if results are available
            if (!empty($responseData['status']) && $responseData['status'] == 'OK') {
                $location = $responseData['results'][0]['geometry']['location'];
                return [
                    'lat' => $location['lat'],
                    'lng' => $location['lng']
                ];
            }

            // Return null if no results found
            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    
    private static function formatValue($type, $value)
    {
        switch ($type) {
            case 'integer':
                return (int) $value;
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'json':
                return json_decode($value, true);
            default:
                return $value;
        }
    }
    
}
