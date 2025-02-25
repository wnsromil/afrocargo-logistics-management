<?php

namespace App\Http\Controllers;

use App\Models\TermsCondition;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TermsConditionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => TermsCondition::all()
        ]);
    }

    public function getAllData()
    {
        return TermsCondition::all();
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['description' => 'required']);

        $term = TermsCondition::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Term added successfully',
            'data' => $term
        ], 201);
    }

    public function show(TermsCondition $termsCondition): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $termsCondition
        ]);
    }

    public function update(Request $request, TermsCondition $termsCondition): JsonResponse
    {
        $request->validate(['description' => 'required']);

        $termsCondition->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Term updated successfully',
            'data' => $termsCondition
        ]);
    }

    public function destroy(TermsCondition $termsCondition): JsonResponse
    {
        $termsCondition->delete();

        return response()->json([
            'success' => true,
            'message' => 'Term deleted successfully'
        ]);
    }
}
