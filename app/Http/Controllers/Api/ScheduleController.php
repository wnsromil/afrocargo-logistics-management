<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LocationSchedule;
use App\Models\Availability;
use App\Models\WeeklySchedule;


class ScheduleController extends Controller
{

    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $date = $request->date;
        $location = $request->location;
        $dayName = strtolower(Carbon::parse($date)->format('l'));

        $slotsSet = [];
        $availabilities = Availability::where('date', $date)->get()->keyBy('user_id');

        // Location wale users nikalo
        $userIds = LocationSchedule::where('address', $location)->pluck('user_id');
        foreach ($userIds as $userId) {
            $availablePeriods = [];

            // Step 1: Check availability table se user ki entry
            if (isset($availabilities[$userId])) {
                $avail = $availabilities[$userId];
                foreach (['morning', 'afternoon', 'evening'] as $period) {
                    if ($avail->$period == 1) {
                        $availablePeriods[] = $period;
                    }
                }

                // Agar koi period 1 nahi mila, skip this user
                if (empty($availablePeriods)) {
                    continue;
                }
            } else {
                // Step 2: availability record nahi mila => sab periods maan lo
                $availablePeriods = ['morning', 'afternoon', 'evening'];
            }

            // Step 3: Weekly schedule nikaalo
            $weekly = WeeklySchedule::where('user_id', $userId)
                ->where('day', $dayName)
                ->first();

            if (!$weekly) continue;

            // Step 4: time slots banao
            foreach ($availablePeriods as $period) {
                $startField = $period . '_start';
                $endField = $period . '_end';

                if ($weekly->$startField && $weekly->$endField) {
                    $start = Carbon::parse($weekly->$startField);
                    $end = Carbon::parse($weekly->$endField);

                    $current = $start->copy();
                    while ($current->lt($end)) {
                        $next = $current->copy()->addHour();
                        if ($next->gt($end)) break;

                        $slot = $current->format('h:i A') . ' - ' . $next->format('h:i A');
                        $slotsSet[$period][$slot] = true;

                        $current = $next;
                    }
                }
            }
        }

        // Final formatting
        $finalSlots = [];
        foreach (['morning', 'afternoon', 'evening'] as $period) {
            $finalSlots[$period] = isset($slotsSet[$period])
                ? array_keys($slotsSet[$period])
                : [];
        }

        return response()->json($finalSlots);
    }
}
