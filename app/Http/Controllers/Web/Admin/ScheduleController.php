<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\LocationSchedule;
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
        $availabilityData = $request->validate($rules);

        // Additional data
        $availabilityData['creates_by'] = auth()->id();
        $availabilityData['user_id'] = $request->user_id;
        $availabilityData['is_active'] = 1;

        // Time slot availability processing
        $availabilityData['morning'] = $request->input('morning') === 'Inactive' ? 0 : 1;
        $availabilityData['afternoon'] = $request->input('afternoon') === 'Inactive' ? 0 : 1;
        $availabilityData['evening'] = $request->input('evening') === 'Inactive' ? 0 : 1;

        // Create the record
        $availability = Availability::create($availabilityData);

        return redirect()->route('admin.drivers.schedule', [
            'id' => $request->user_id,
        ])->with('success', 'Schedule saved successfully.')
            ->header('Location', route('admin.drivers.schedule', ['id' => $request->user_id]) . '?tab=availability');
    }

    public function weeklyScheduleStore(Request $request)
    {
        $userId = $request->user_id;
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        // Get existing schedule days from DB
        $existingSchedules = WeeklySchedule::where('user_id', $userId)->pluck('day')->toArray();

        $submittedDays = []; // Days user has submitted

        foreach ($days as $day) {
            if ($request->has($day)) {
                $submittedDays[] = $day;

                $morning_start = $request->filled("{$day}_morning_start") ? $this->convertTo24HourFormat($request->input("{$day}_morning_start")) : null;
                $morning_end = $request->filled("{$day}_morning_end") ? $this->convertTo24HourFormat($request->input("{$day}_morning_end")) : null;
                $afternoon_start = $request->filled("{$day}_afternoon_start") ? $this->convertTo24HourFormat($request->input("{$day}_afternoon_start")) : null;
                $afternoon_end = $request->filled("{$day}_afternoon_end") ? $this->convertTo24HourFormat($request->input("{$day}_afternoon_end")) : null;
                $evening_start = $request->filled("{$day}_evening_start") ? $this->convertTo24HourFormat($request->input("{$day}_evening_start")) : null;
                $evening_end = $request->filled("{$day}_evening_end") ? $this->convertTo24HourFormat($request->input("{$day}_evening_end")) : null;

                $scheduleData = [
                    'creates_by' => auth()->id(),
                    'day' => $day,
                    'date' => null,
                    'morning_start' => $morning_start,
                    'morning_end' => $morning_end,
                    'afternoon_start' => $afternoon_start,
                    'afternoon_end' => $afternoon_end,
                    'evening_start' => $evening_start,
                    'evening_end' => $evening_end,
                    'is_active' => 1,
                    'user_id' => $userId,
                    'availability_id' => null,
                ];

                // Update or create entry
                $existing = WeeklySchedule::where('user_id', $userId)->where('day', $day)->first();
                if ($existing) {
                    $existing->update($scheduleData);
                } else {
                    WeeklySchedule::create($scheduleData);
                }
            }
        }

        // 🧹 Delete unchecked days (i.e., removed from form)
        $daysToDelete = array_diff($existingSchedules, $submittedDays);
        if (!empty($daysToDelete)) {
            WeeklySchedule::where('user_id', $userId)
                ->whereIn('day', $daysToDelete)
                ->delete();
        }

        return redirect()->route('admin.drivers.schedule', ['id' => $request->user_id])
            ->with('success', 'Schedule saved successfully.')
            ->header('Location', route('admin.drivers.schedule', ['id' => $request->user_id]) . '?tab=weekly');
    }


    public function locationStore(Request $request)
    {
        $rules = [
            'address' => 'required|string',
        ];

        $availabilityData = $request->validate($rules);

        // Common data
        $availabilityData['creates_by'] = auth()->id();
        $availabilityData['user_id'] = $request->user_id;
        $availabilityData['lat'] = "55";
        $availabilityData['lng'] = "86";
        $availabilityData['is_active'] = 1;

        // Check if record exists for the user_id
        $existing = LocationSchedule::where('user_id', $request->user_id)->first();

        if ($existing) {
            // Update existing record
            $existing->update($availabilityData);
            return redirect()->route('admin.drivers.schedule', [
                'id' => $request->user_id,
            ])->with('success', 'Location update successfully.')
                ->header('Location', route('admin.drivers.schedule', ['id' => $request->user_id]) . '?tab=location');
        } else {
            // Create new record
            LocationSchedule::create($availabilityData);
            return redirect()->route('admin.drivers.schedule', [
                'id' => $request->user_id,
            ])->with('success', 'Location saved successfully.')
                ->header('Location', route('admin.drivers.schedule', ['id' => $request->user_id]) . '?tab=location');
        }
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
