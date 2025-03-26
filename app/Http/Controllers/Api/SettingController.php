<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\SettingsHelper;

class SettingController extends Controller
{
    public function getGlobalSettings()
    {
        return response()->json(['settings' => $this->getSettings(null)]);
    }

    public function updateGlobalSettings(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array'
        ]);

        foreach ($validated['settings'] as $key => $config) {
            SettingsHelper::setGlobal(
                $key,
                $config['value'] ?? null,
                $config['type'] ?? 'string',
                $config['default_value'] ?? null
            );
        }

        return response()->json(['status' => 'success', 'message' => 'Global settings updated']);
    }

    public function getProjectSettings($projectId)
    {
        return response()->json(['settings' => $this->getSettings($projectId)]);
    }

    public function updateProjectSettings(Request $request, $projectId)
    {
        $validated = $request->validate([
            'settings' => 'required|array'
        ]);

        foreach ($validated['settings'] as $key => $config) {
            SettingsHelper::set(
                $projectId,
                $key,
                $config['value'] ?? null,
                $config['type'] ?? 'string',
                $config['default_value'] ?? null
            );
        }

        return response()->json(['status' => 'success', 'message' => 'Project settings updated']);
    }

    private function getSettings($projectId)
    {
        $keys = Setting::whereNull('project_id')->pluck('key')->toArray();
        $settings = [];

        foreach ($keys as $key) {
            $settings[$key] = [
                'value' => SettingsHelper::get($projectId, $key),
                'type' => Setting::where('key', $key)->value('type'),
                'default_value' => Setting::where('key', $key)->value('default_value'),
            ];
        }

        return $settings;
    }
}

