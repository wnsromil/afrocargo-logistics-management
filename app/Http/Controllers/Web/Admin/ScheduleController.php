<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\WeeklySchedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Availability store
        $availabilityData = $request->validate([
            'date' => 'required|date',
            // 'lat' => 'nullable|string',
            // 'lng' => 'nullable|string',
            'address' => 'required|string',
            'morning' => 'nullable|string',
            'afternoon' => 'nullable|string',
            'evening' => 'nullable|string',
            //'is_active' => 'nullable|boolean',
        ]);
        $availabilityData['creates_by'] = auth()->id();
        $availabilityData['user_id'] =  $request->user_id;
        $availabilityData['lat'] = "55";
        $availabilityData['lng'] = "86";
        $availabilityData['is_active'] = 1;
        $availabilityData['morning'] = ($request->filled('morning') && $request->input('morning') === 'Inactive') ? 0 : 1;
        $availabilityData['afternoon'] = ($request->filled('afternoon') && $request->input('afternoon') === 'Inactive') ? 0 : 1;
        $availabilityData['evening'] = ($request->filled('evening') && $request->input('evening') === 'Inactive') ? 0 : 1;
        $availability = Availability::create($availabilityData);

        // WeeklySchedule store if checkbox is checked
        if ($request->has('is_location_available') && $request->is_location_available) {
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            foreach ($days as $day) {
                if ($request->input("{$day}_active")) {
                    $scheduleData = [
                        'creates_by' =>  auth()->id(),
                        'day' => $day,
                        'date' => $request->date,
                        'morning_start' => $request->input("{$day}_morning_start"),
                        'morning_end' => $request->input("{$day}_morning_end"),
                        'afternoon_start' => $request->input("{$day}_afternoon_start"),
                        'afternoon_end' => $request->input("{$day}_afternoon_end"),
                        'evening_start' => $request->input("{$day}_evening_start"),
                        'evening_end' => $request->input("{$day}_evening_end"),
                        'is_active' => 1,
                        'user_id' =>  $request->user_id,
                        'availability_id' => $availability->id,
                    ];

                    WeeklySchedule::create($scheduleData);
                }
            }
        }

        return redirect()->route('admin.drivers.schedule', ['id' => $request->user_id])
            ->with('success', 'Schedule saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
