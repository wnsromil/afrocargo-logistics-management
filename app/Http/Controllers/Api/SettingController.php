<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getProjectSettings(Request $request)
    {
        $key =null;
        if(!empty($request->key)){
            $key = $request->key;
        }
        return response()->json(['settings' => $this->getSettings($key)]);
    }

    public function updateProjectSettings(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array'
        ]);

        foreach ($validated['settings'] as $key => $config) {
            setting()->set(
                $key,
                $config['value'] ?? null,
                $config['type'] ?? 'string',
                $config['default_value'] ?? null
            );
        }

        return response()->json(['status' => 'success', 'message' => 'Project settings updated']);
    }

    private function getSettings($key=null)
    {
        if(!empty($key)){
            return setting()->get($key);
        }
        return setting()->getAll();
    }
}

