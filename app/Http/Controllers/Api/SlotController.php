<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookedSlot;

class SlotController extends Controller
{
    // Get available slots
    public function getAvailableSlots(Request $request)
    {
        $config = [
            'date' => $request->query('date', date('Y-m-d')),
            'date_format' => 'Y-m-d',
            'slot_duration' => 30,  // minutes
            'slot_padding' => 5,    // minutes
            'time_format' => 'H:i',
            'show_past_slots'=>true,
            "show_date"=>true,
            'minimum_booking_time' => 2, // hours before booking
            // 'max_slots_per_day' => 10,   // max slots per day
            // 'custom_blocked_slots' => ["14:00-14:30"],
            'shifts' => [
                'Morning' => ['start' => '08:00', 'end' => '12:00'],
                'Afternoon' => ['start' => '13:00', 'end' => '17:00'],
                'Evening' => ['start' => '18:00', 'end' => '21:00']
            ]
        ];

        return response()->json(generateTimeSlots($config));
    }

    // Book a slot
    public function bookSlot(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|integer',
            'date' => 'required|date',
            'slot' => 'required|string',
        ]);

        return response()->json($this->saveBookedSlot($request->project_id, $request->date, $request->slot));
    }

    // Get booked slots
    public function getBookedSlots(Request $request)
    {
        $bookedSlots = BookedSlot::where('project_id', $request->query('project_id'))
            ->where('date', $request->query('date', date('Y-m-d')))
            ->pluck('slot')
            ->toArray();

        return response()->json([
            'date' => $request->query('date', date('Y-m-d')),
            'booked_slots' => $bookedSlots
        ]);
    }

    // Cancel a booking
    public function cancelBooking(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|integer',
            'date' => 'required|date',
            'slot' => 'required|string',
        ]);

        BookedSlot::where('project_id', $request->project_id)
            ->where('date', $request->date)
            ->where('slot', $request->slot)
            ->delete();

        return response()->json(['status' => 'success', 'message' => 'Booking canceled successfully']);
    }

    // Save booked slot
    private function saveBookedSlot(int $projectId, string $date, string $slot)
    {
        if (BookedSlot::where('project_id', $projectId)->where('date', $date)->where('slot', $slot)->exists()) {
            return ['status' => 'error', 'message' => 'Slot already booked'];
        }

        BookedSlot::create(['project_id' => $projectId, 'date' => $date, 'slot' => $slot]);

        return ['status' => 'success', 'message' => 'Slot booked successfully'];
    }
}

