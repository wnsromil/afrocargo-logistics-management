<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TermsCondition;
use App\Models\PrivacyPolicy;
use Illuminate\Http\JsonResponse;
use App\Models\AboutUs;

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
}

