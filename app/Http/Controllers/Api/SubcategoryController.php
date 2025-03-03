<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return response()->json(Subcategory::with('category')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $subcategory = Subcategory::create($request->all());

        return response()->json(['message' => 'Subcategory created successfully', 'data' => $subcategory]);
    }

    public function show($id)
    {
        return response()->json(Subcategory::with('category')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id'
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());

        return response()->json(['message' => 'Subcategory updated successfully', 'data' => $subcategory]);
    }

    public function destroy($id)
    {
        Subcategory::findOrFail($id)->delete();

        return response()->json(['message' => 'Subcategory deleted successfully']);
    }

    public function getSubcategoriesByCategoryId($categoryId)
    {
        // Category ki sabhi subcategories fetch karein, aur created_at, updated_at ko hide karein
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->get(['id', 'name', 'category_id']); // Sirf ye fields rakhein

        // Agar subcategories milti hain to response bhejein
        if ($subcategories->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Subcategories fetched successfully!',
                'data' => $subcategories
            ], 200);
        }

        // Agar koi subcategory nahi mili
        return response()->json([
            'success' => false,
            'message' => 'No subcategories found for this category!',
            'data' => []
        ], 404);
    }
}
