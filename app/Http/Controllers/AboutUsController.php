<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AboutUsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(AboutUs::all());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['description' => 'required']);
        return response()->json(AboutUs::create($request->all()));
    }

    public function show(AboutUs $aboutUs): JsonResponse
    {
        return response()->json($aboutUs);
    }

    public function update(Request $request, AboutUs $aboutUs): JsonResponse
    {
        $request->validate(['description' => 'required']);
        $aboutUs->update($request->all());
        return response()->json($aboutUs);
    }

    public function destroy(AboutUs $aboutUs): JsonResponse
    {
        $aboutUs->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
