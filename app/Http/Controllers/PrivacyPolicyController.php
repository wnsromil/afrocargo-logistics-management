<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        return response()->json(PrivacyPolicy::all());
    }

    public function getAllData()
    {
        return PrivacyPolicy::all();
    }


    public function store(Request $request)
    {
        $request->validate(['description' => 'required']);
        return PrivacyPolicy::create($request->all());
    }

    public function show(PrivacyPolicy $privacyPolicy)
    {
        return response()->json($privacyPolicy);
    }

    public function update(Request $request, PrivacyPolicy $privacyPolicy)
    {
        $request->validate(['description' => 'required']);
        $privacyPolicy->update($request->all());
        return response()->json($privacyPolicy);
    }

    public function destroy(PrivacyPolicy $privacyPolicy)
    {
        $privacyPolicy->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
