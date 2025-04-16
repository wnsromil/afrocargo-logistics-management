<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    public function index()
    {
        $data = Availability::where('user_id',auth()->id())->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'creates_by' => 'nullable|integer',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'address' => 'nullable|string',
            'morning' => 'nullable|boolean',
            'afternoon' => 'nullable|boolean',
            'evening' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data['user_id'] = auth()->id();

        $availability = Availability::updateOrCreate(
            ['user_id' => $data['user_id'], 'date' => $data['date']], // match condition
            $data // values to update
        );

        return response()->json($availability, 200);
    }


    public function show(Availability $availability)
    {
        return $availability;
    }

    public function update(Request $request, Availability $availability)
    {
        $data = $request->validate([
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'address' => 'nullable|string',
            'date' => 'nullable|date',
            'morning' => 'nullable|boolean',
            'afternoon' => 'nullable|boolean',
            'evening' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $availability->update($data);
        return response()->json($availability);
    }

    public function destroy(Availability $availability)
    {
        $availability->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
