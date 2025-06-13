<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TermsCondition;
use App\Models\PrivacyPolicy;
use Illuminate\Http\JsonResponse;
use App\Models\AboutUs;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getTermsConditions(): JsonResponse
    {
        return response()->json(TermsCondition::all());
    }

    public function getPrivacyPolicies(): JsonResponse
    {
        return response()->json(PrivacyPolicy::all());
    }

    public function getAboutUs(): JsonResponse
    {
        return response()->json(AboutUs::all());
    }

    public function getCountryByName(Request $request)
    {
        // Validate request input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 400);
        }

        // Find country by name
        $country = Country::where('name', $request->input('name'))->first();

        if (!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $country
        ]);
    }
}

