<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\LocationSchedule;
use App\Models\WeeklySchedule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


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

        $request->merge([
            'date' => $request->input('date') ?? Carbon::today()->format('Y-m-d')
        ]);

        $rules = [
            'date' => 'required|date',
            'morning' => 'nullable|string',
            'afternoon' => 'nullable|string',
            'evening' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        // Add custom rule for checking duplicate active date
        $validator->after(function ($validator) use ($request) {
            $exists = Availability::where('date', $request->date)
                ->where('is_active', 1)
                ->where('user_id', $request->user_id)
                ->exists();

            if ($exists) {
                $validator->errors()->add('date', 'Already scheduled for this date.');
            }
        });

        $availabilityData = $validator->validate();
        $existingLocationId = LocationSchedule::where('user_id', $request->user_id)
            ->latest()
            ->value('id');

        // Additional data
        $availabilityData['creates_by'] = auth()->id();
        $availabilityData['user_id'] = $request->user_id;
        $availabilityData['is_active'] = 1;
        if(!$request->is_for_all_location){
            $availabilityData['location_id'] = $existingLocationId;
        }
       

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

        if($request->id && $request->type == 'delete'){
            LocationSchedule::where('id',$request->id)->delete();
            return redirect()->route('admin.drivers.schedule', [
                'id' => $request->user_id,
            ])->with('success', 'Location deleted successfully.')
                ->header('Location', route('admin.drivers.schedule', ['id' => $request->user_id]) . '?tab=location');
        }

        $availabilityData = $request->validate($rules);

        // Common data
        $availabilityData['creates_by'] = auth()->id();
        $availabilityDataIfUpdate['user_id'] = $request->user_id;
        $availabilityDataIfUpdate['lat'] = $request->latitude;;
        $availabilityDataIfUpdate['lng'] = $request->longitude;;
        $availabilityData['is_active'] = 1;

        // Check if record exists for the user_id
        $existing = LocationSchedule::where('user_id', $request->user_id)->first();


        // Create new record
        LocationSchedule::updateOrCreate($availabilityDataIfUpdate,$availabilityData);
        return redirect()->route('admin.drivers.schedule', [
            'id' => $request->user_id,
        ])->with('success', 'Location saved successfully.')
            ->header('Location', route('admin.drivers.schedule', ['id' => $request->user_id]) . '?tab=location');
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
    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
            'morning' => 'nullable|string',
            'afternoon' => 'nullable|string',
            'evening' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        // Record ko ID se fetch karo
        $availability = Availability::find($request->id);

        if (!$availability) {
            return redirect()->back()->with('error', 'Availability record not found.');
        }

        // Update fields (date ko touch nahi karna)
        $availability->update([
            'morning' => $request->has('morning') && $request->input('morning') == 0 ? 0 : 1,
            'afternoon' => $request->has('afternoon') && $request->input('afternoon') == 0 ? 0 : 1,
            'evening' => $request->has('evening') && $request->input('evening') == 0 ? 0 : 1,
            'is_active' => 1,
            'creates_by' => auth()->id(),
        ]);


        return redirect()->route('admin.drivers.schedule', [
            'id' => $availability->user_id,
        ])->with('success', 'Schedule updated successfully.')
            ->header('Location', route('admin.drivers.schedule', ['id' => $availability->user_id]) . '?tab=availability');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
