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
        $rules = [
            'date' => 'nullable|date',
            'morning' => 'nullable|string',
            'afternoon' => 'nullable|string',
            'evening' => 'nullable|string',
        ];

        if ($request->has('is_location_available')) {
            $rules['address'] = 'required|string';
        } else {
            $rules['address'] = 'nullable|string';
        }

        $availabilityData = $request->validate($rules);

        // Additional data
        $availabilityData['creates_by'] = auth()->id();
        $availabilityData['user_id'] = $request->user_id;
        $availabilityData['lat'] = "55";
        $availabilityData['lng'] = "86";
        $availabilityData['is_active'] = 1;

        // Time slot availability processing
        $availabilityData['morning'] = $request->input('morning') === 'Inactive' ? 0 : 1;
        $availabilityData['afternoon'] = $request->input('afternoon') === 'Inactive' ? 0 : 1;
        $availabilityData['evening'] = $request->input('evening') === 'Inactive' ? 0 : 1;

        // Create the record
        $availability = Availability::create($availabilityData);

        // WeeklySchedule store if checkbox is checked

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            // Check if checkbox for that day is ticked
            if ($request->has($day)) {
                // Function to convert 12-hour format to 24-hour format
                // Convert times to 24-hour format
                $morning_start = $request->filled("{$day}_morning_start") ? $this->convertTo24HourFormat($request->input("{$day}_morning_start")) : null;
                $morning_end = $request->filled("{$day}_morning_end") ? $this->convertTo24HourFormat($request->input("{$day}_morning_end")) : null;
                $afternoon_start = $request->filled("{$day}_afternoon_start") ? $this->convertTo24HourFormat($request->input("{$day}_afternoon_start")) : null;
                $afternoon_end = $request->filled("{$day}_afternoon_end") ? $this->convertTo24HourFormat($request->input("{$day}_afternoon_end")) : null;
                $evening_start = $request->filled("{$day}_evening_start") ? $this->convertTo24HourFormat($request->input("{$day}_evening_start")) : null;
                $evening_end = $request->filled("{$day}_evening_end") ? $this->convertTo24HourFormat($request->input("{$day}_evening_end")) : null;


                $scheduleData = [
                    'creates_by' => auth()->id(),
                    'day' => $day, // just the day name like 'monday'
                    'date' => $request->date,
                    'morning_start' => $morning_start,
                    'morning_end' => $morning_end,
                    'afternoon_start' => $afternoon_start,
                    'afternoon_end' => $afternoon_end,
                    'evening_start' => $evening_start,
                    'evening_end' => $evening_end,
                    'is_active' => 1,
                    'user_id' => $request->user_id,
                    'availability_id' => $availability->id,
                ];

                WeeklySchedule::create($scheduleData);
            }
        }

        return redirect()->route('admin.drivers.schedule', ['id' => $request->user_id])
            ->with('success', 'Schedule saved successfully.');
    }

    public function weeklyScheduleStore(Request $request)
    {
        // WeeklySchedule store if checkbox is checked

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            // Check if checkbox for that day is ticked
            if ($request->has($day)) {
                // Function to convert 12-hour format to 24-hour format
                // Convert times to 24-hour format
                $morning_start = $request->filled("{$day}_morning_start") ? $this->convertTo24HourFormat($request->input("{$day}_morning_start")) : null;
                $morning_end = $request->filled("{$day}_morning_end") ? $this->convertTo24HourFormat($request->input("{$day}_morning_end")) : null;
                $afternoon_start = $request->filled("{$day}_afternoon_start") ? $this->convertTo24HourFormat($request->input("{$day}_afternoon_start")) : null;
                $afternoon_end = $request->filled("{$day}_afternoon_end") ? $this->convertTo24HourFormat($request->input("{$day}_afternoon_end")) : null;
                $evening_start = $request->filled("{$day}_evening_start") ? $this->convertTo24HourFormat($request->input("{$day}_evening_start")) : null;
                $evening_end = $request->filled("{$day}_evening_end") ? $this->convertTo24HourFormat($request->input("{$day}_evening_end")) : null;


                $scheduleData = [
                    'creates_by' => auth()->id(),
                    'day' => $day, // just the day name like 'monday'
                    'date' => null,
                    'morning_start' => $morning_start,
                    'morning_end' => $morning_end,
                    'afternoon_start' => $afternoon_start,
                    'afternoon_end' => $afternoon_end,
                    'evening_start' => $evening_start,
                    'evening_end' => $evening_end,
                    'is_active' => 1,
                    'user_id' => $request->user_id,
                    'availability_id' => null,
                ];

                WeeklySchedule::create($scheduleData);
            }
        }

        return redirect()->route('admin.drivers.schedule', ['id' => $request->user_id])
            ->with('success', 'Schedule saved successfully.');
    }



    function convertTo24HourFormat($time)
    {
        return \Carbon\Carbon::createFromFormat('h:i A', $time)->format('H:i:s');
    }

    function convertTo12HourFormat($time)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $time)->format('h:i A');
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
