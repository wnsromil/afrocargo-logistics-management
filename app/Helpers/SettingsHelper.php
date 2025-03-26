<?php
namespace App\Helpers;

use App\Models\Setting;

class SettingsHelper
{
    public static function get($projectId, $key, $default = null)
    {
        // Try to get project-specific setting
        $setting = Setting::where('project_id', $projectId)->where('key', $key)->first();

        // If not found, fall back to global setting
        if (!$setting) {
            $setting = Setting::whereNull('project_id')->where('key', $key)->first();
        }

        // Return setting value or default
        return $setting ? self::formatValue($setting->type, $setting->value) : $default;
    }

    public static function set($projectId, $key, $value, $type = 'string', $defaultValue = null)
    {
        return Setting::updateOrCreate(
            ['project_id' => $projectId, 'key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'type' => $type, 'default_value' => $defaultValue]
        );
    }

    public static function setGlobal($key, $value, $type = 'string', $defaultValue = null)
    {
        return Setting::updateOrCreate(
            ['project_id' => null, 'key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'type' => $type, 'default_value' => $defaultValue]
        );
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
