<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WeeklySchedule;


class WeeklySchedulesController extends Controller
{
    public function index()
    {
        $data = WeeklySchedule::where('user_id',auth()->id())->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'creates_by' => 'nullable|integer',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'morning_start' => 'nullable|date_format:H:i',
            'morning_end' => 'nullable|date_format:H:i',
            'afternoon_start' => 'nullable|date_format:H:i',
            'afternoon_end' => 'nullable|date_format:H:i',
            'evening_start' => 'nullable|date_format:H:i',
            'evening_end' => 'nullable|date_format:H:i',
            'is_active' => 'nullable|boolean',
        ]);

        $data['user_id'] = auth()->id();

        $schedule = WeeklySchedule::updateOrCreate(
            ['user_id' => $data['user_id'], 'day' => $data['day']], // Match condition
            $data // Data to insert/update
        );

        return response()->json($schedule, 200);
    }


    public function show(WeeklySchedule $weeklySchedule)
    {
        return $weeklySchedule;
    }

    public function update(Request $request, WeeklySchedule $weeklySchedule)
    {
        $data = $request->validate([
            'day' => 'sometimes|required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'morning_start' => 'nullable|date_format:H:i',
            'morning_end' => 'nullable|date_format:H:i',
            'afternoon_start' => 'nullable|date_format:H:i',
            'afternoon_end' => 'nullable|date_format:H:i',
            'evening_start' => 'nullable|date_format:H:i',
            'evening_end' => 'nullable|date_format:H:i',
            'is_active' => 'nullable|boolean',
        ]);

        $weeklySchedule->update($data);
        return response()->json($weeklySchedule);
    }

    public function destroy(WeeklySchedule $weeklySchedule)
    {
        $weeklySchedule->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

