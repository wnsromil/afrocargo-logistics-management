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
            'slot_duration' => 30,  // minutes
            'slot_padding' => 5,    // minutes
            'time_format' => 'H:i',
            'minimum_booking_time' => 2, // hours before booking
            // 'max_slots_per_day' => 10,   // max slots per day
            // 'custom_blocked_slots' => ["14:00-14:30"],
        ];

        return response()->json($this->generateTimeSlots($config));
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

    // Function to generate time slots
    private function generateTimeSlots(array $config, int $projectId = null)
    {
        $defaultConfig = [
            'date_format' => 'd/m/Y',
            'time_format' => 'h:i A',
            'working_hours' => ['start' => '09:00', 'end' => '18:00'],
            'breaks' => [
                ['start' => '12:30', 'end' => '13:30'], 
                ['start' => '15:00', 'end' => '15:15']
            ],
            'weekends' => ['Saturday', 'Sunday'],
            'holidays' => [],
            'custom_blocked_slots' => [],
        ];

        $config = array_merge($defaultConfig, array_filter($config));
        $date = $config['date'];

        // Fetch booked slots from database
        $bookedSlots = BookedSlot::where('date', $date)
            ->pluck('slot')
            ->toArray();

        // If it's a weekend or holiday, return no slots
        if (in_array(date('l', strtotime($date)), $config['weekends']) || in_array($date, $config['holidays'])) {
            return [
                'date' => date($config['date_format'], strtotime($date)),
                'time_slots' => [],
                'message' => "No slots available (Weekend or Holiday)"
            ];
        }

        $output = ['date' => date($config['date_format'], strtotime($date)), 'time_slots' => []];

        $startTime = strtotime($config['working_hours']['start']);
        $endTime = strtotime($config['working_hours']['end']);
        $duration = $config['slot_duration'] * 60;
        $padding = $config['slot_padding'] * 60;

        while ($startTime < $endTime) {
            $nextTime = $startTime + $duration;
            if ($nextTime > $endTime) break;

            $formattedSlot = date($config['time_format'], $startTime) . " to " . date($config['time_format'], $nextTime);
            $slotKey = date("H:i", $startTime) . "-" . date("H:i", $nextTime);

            $isBreakTime = false;
            foreach ($config['breaks'] as $break) {
                if (strtotime($break['start']) <= $startTime && strtotime($break['end']) > $startTime) {
                    $isBreakTime = true;
                    break;
                }
            }

            $isAvailable = !$isBreakTime && !in_array($slotKey, $bookedSlots) && !in_array($slotKey, $config['custom_blocked_slots']);

            if ($config['minimum_booking_time'] > 0 && (strtotime($date . ' ' . date("H:i", $startTime)) - time()) < ($config['minimum_booking_time'] * 3600)) {
                $isAvailable = false;
            }

            $output['time_slots'][] = ['slot' => $formattedSlot, 'available' => $isAvailable];
            $startTime = $nextTime + $padding;
        }

        return $output;
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

