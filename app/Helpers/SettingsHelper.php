<?php
namespace App\Helpers;

use App\Models\{Setting,ParcelStatus};

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
