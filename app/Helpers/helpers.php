<?php

function isActive($urls, $class = 'active',$default='')
{
    
    if (!is_array($urls)) {
        $urls = explode(',',$urls);
        if(count($urls) > 1){
            foreach ((array) $urls as $url) {
                if (request()->is($url)) {
                    return $class;
                }
            }
        }
        if (request()->is($urls[0])) {
            return $class;
        }
    }
    foreach ((array) $urls as $url) {
        if (request()->is($url)) {
            return $class;
        }
    }
    return $default;
}

function activeStatusKey($statusName = 'Pending') {
    
    $parcelStatuses = collect([
        'pending'                => 'Pending',
        'pickup_assign'          => 'Pickup Assign',//admin
        'pickup_reschedule'      => 'Pickup Re-Schedule',
        'received_by_pickup_man' => 'Received By Pickup Man',
        'received_warehouse'     => 'Received Warehouse',
        'transfer_to_hub'        => 'Transfer to Hub',
        'received_by_hub'        => 'Received by Hub',
        'delivery_man_assign'    => 'Delivery Man Assign',
        'return_to_courier'      => 'Return to Courier',
        'delivered'              => 'Delivered',
        'cancelled'              => 'Cancelled',
        'created'                => 'Created',
        'updated'                => 'Updated',
        'deleted'                => 'Deleted',
        'archived'               => 'Archived',
        'rejected'               => 'Rejected',
        'completed'              => 'Completed',
        'on_hold'                => 'On Hold',
        'partial'                => 'Partial',
    ]);

    // Return the key if found, or 'pending' if not.
    return str_replace(' ','_',strtolower($statusName));
}

function generateTimeSlots(array $config = [], array $bookedSlotsByProject = [], string $project = 'default')
{
    // Default configuration
    $defaultConfig = [
        'date_format' => 'd/m/Y',
        'time_format' => 'h:i A', // Default to 12-hour format
        'date' => date('Y-m-d'),
        'slot_duration' => 15,
        'slot_padding' => 0, // Additional time between slots (e.g., 5 min setup time)
        'working_hours' => ['start' => '09:00', 'end' => '18:00'],
        'breaks' => [
            ['start' => '12:30', 'end' => '13:30'], // Lunch break
            ['start' => '15:00', 'end' => '15:15']  // Tea break
        ],
        'weekends' => ['Saturday', 'Sunday'],
        'holidays' => [],
        'custom_blocked_slots' => [], // Custom blocked slots
        'minimum_booking_time' => 0, // Minimum hours before booking a slot
        'max_slots_per_day' => null, // Limit on number of available slots
        'availability' => function ($slotKey, $date, $bookedSlots) {
            return !in_array($slotKey, $bookedSlots);
        }
    ];

    // Merge user config with defaults
    $config = array_merge($defaultConfig, array_filter($config));

    // Get project-specific booked slots
    $bookedSlots = $bookedSlotsByProject[$project] ?? [];

    // Validate date
    if (empty($config['date']) || !strtotime($config['date'])) {
        $config['date'] = date('Y-m-d');
    }

    $date = $config['date'];
    $dayOfWeek = date('l', strtotime($date));

    // If it's a weekend or holiday, return no slots
    if (in_array($dayOfWeek, $config['weekends']) || in_array($date, $config['holidays'])) {
        return [
            'date' => date($config['date_format'], strtotime($date)),
            'time_slots' => [],
            'message' => "No slots available (Weekend or Holiday)"
        ];
    }

    $output = [
        'date' => date($config['date_format'], strtotime($date)),
        'time_slots' => []
    ];

    // Ensure working hours exist
    $startTime = strtotime($config['working_hours']['start']);
    $endTime = strtotime($config['working_hours']['end']);
    $duration = $config['slot_duration'] * 60;
    $padding = $config['slot_padding'] * 60;

    $totalSlots = 0;
    while ($startTime < $endTime) {
        $nextTime = $startTime + $duration;
        if ($nextTime > $endTime) break;

        // Convert to chosen format
        $formattedSlot = date($config['time_format'], $startTime) . "-" . date($config['time_format'], $nextTime);
        $slotKey = date("H:i", $startTime) . "-" . date("H:i", $nextTime);

        // Check if slot falls within break times
        $isBreakTime = false;
        foreach ($config['breaks'] as $break) {
            $breakStart = strtotime($break['start']);
            $breakEnd = strtotime($break['end']);
            if (($startTime >= $breakStart && $startTime < $breakEnd) || ($nextTime > $breakStart && $nextTime <= $breakEnd)) {
                $isBreakTime = true;
                break;
            }
        }

        // Check availability based on booked slots and breaks
        $isAvailable = !$isBreakTime && !in_array($slotKey, $bookedSlots) && !in_array($slotKey, $config['custom_blocked_slots']);

        // Apply dynamic availability function if provided
        if (is_callable($config['availability'])) {
            $isAvailable = $config['availability']($slotKey, $date, $bookedSlots);
        }

        // Check minimum booking time restriction
        $currentTime = strtotime('now');
        $slotStartTime = strtotime($date . ' ' . date("H:i", $startTime));
        if ($config['minimum_booking_time'] > 0 && $slotStartTime - $currentTime < ($config['minimum_booking_time'] * 3600)) {
            $isAvailable = false;
        }

        // Limit the number of slots per day
        if ($config['max_slots_per_day'] !== null && $totalSlots >= $config['max_slots_per_day']) {
            break;
        }

        $output['time_slots'][] = [
            'slot' => $formattedSlot,
            'available' => $isAvailable
        ];

        $totalSlots++;
        $startTime = $nextTime + $padding; // Add padding time before next slot
    }

    return $output;
}
