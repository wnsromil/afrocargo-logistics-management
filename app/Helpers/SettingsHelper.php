<?php
namespace App\Helpers;

use App\Models\{
    Setting,
    ParcelStatus,
    Warehouse,
    Country
};

class SettingsHelper
{
    public static function get($key=null, $default = null)
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

    public static function statusList(){
        return ParcelStatus::get();
    }

    public static function warehouseContries()
    {
        // Get distinct country names from warehouses
        $countryNames = Warehouse::select('country_id')->distinct()->pluck('country_id');

        // Fetch country details for each country name using LIKE query
        return Country::where(function($query) use ($countryNames) {
            foreach ($countryNames as $countryName) {
            $query->orWhere('name', 'like', '%' . $countryName);
            }
        })
        ->select('id', 'name', 'iso2', 'iso3', 'phonecode')
        ->get();
    }
    

    private static function formatValue($type, $value)
    {
        switch ($type) {
            case 'integer': return (int) $value;
            case 'boolean': return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'json': return json_decode($value, true);
            default: return $value;
        }
    }
    
}
