<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\LocationSchedule;

class AvailabilityController extends Controller
{
    public function index()
    {
        $data = Availability::where('is_active', 1)
            ->where('user_id', auth()->id())
            ->with('locationName') // Relationship load karne ke liye
            ->orderBy('id', 'desc') // Sort by start_time ascending
            ->get();

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

        $existingLocationId = LocationSchedule::where('user_id', auth()->id())
            ->latest()
            ->value('id');

        $data['user_id'] = auth()->id();
        $data['location_id'] = $existingLocationId;

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

    public function locationStore(Request $request)
    {
        $rules = [
            'address' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $locationData = [
            'address' => $validatedData['address'],
            'creates_by' => auth()->id(),
            'user_id' => auth()->id(),
            'lat' => $request->lat,
            'lng' => $request->lng,
            'is_active' => 1,
        ];

        $existingRecord = LocationSchedule::where('user_id', auth()->id())->first();
        $newRecord = LocationSchedule::create($locationData);
        return response()->json([
            'message' => 'Location saved successfully.',
            'data' => $newRecord,
        ], 201);
    }

    public function locationGet()
    {
        $userId = auth()->id();

        $location = LocationSchedule::where('user_id', $userId)->latest()->get();

        if ($location) {
            return response()->json([
                'message' => 'Location fetched successfully.',
                'data' => $location,
            ], 200);
        } else {
            return response()->json([
                'message' => 'No location found for this user.',
            ], 404);
        }
    }

    public function locationDelete(Request $request)
    {
        $rules = [
            'ids' => 'required|array',
        ];

        $validatedData = $request->validate($rules);

        $userId = auth()->id();

        $location = LocationSchedule::where('user_id', $userId)->where('id',$request->ids)->latest()->get();

        if ($location) {
            return response()->json([
                'message' => 'Location Delete successfully.',
                'data' => $location,
            ], 200);
        } else {
            return response()->json([
                'message' => 'No location found for this user.',
            ], 404);
        }
    }
}
