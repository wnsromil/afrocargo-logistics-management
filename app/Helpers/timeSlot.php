<?php

function generateTimeSlots(array $config = [], array $bookedSlotsByProject = [], string $project = 'default', string $user = 'guest')
{
    // Default configuration
    $defaultConfig = [
        'date_format' => 'd/m/Y',
        'time_format' => 'h:i A',
        'date' => date('Y-m-d'),
        'slot_duration' => 15,
        'slot_padding' => 0,
        'shifts' => [],
        'breaks' => [
            // ['start' => '12:00', 'end' => '13:00'],
            // ['start' => '15:00', 'end' => '15:15']
        ],
        'weekends' => [],
        'holidays' => [],
        'custom_blocked_slots' => [],
        'recurring_blocked_slots' => [
            'Monday' => ['10:00-10:30'],
            'Friday' => ['14:00-14:30']
        ],
        'special_days' => [],
        'user_availability' => [],
        'minimum_booking_time' => 0,
        'max_slots_per_day' => null,
        'max_bookings_per_slot' => 1,
        'priority_users' => [],
        'show_date' => true, // New setting to toggle date display
        'show_time' => true, // New setting to toggle time display
        'show_past_slots' => true, // New setting to toggle time display
        'availability' => function ($slotKey, $date, $bookedSlots) {
            return !in_array($slotKey, $bookedSlots);
        }
    ];

    $config = array_merge($defaultConfig, $config);
    $bookedSlots = $bookedSlotsByProject[$project] ?? [];
    $date = $config['date'];
    $dayOfWeek = date('l', strtotime($date));

    if (in_array($dayOfWeek, $config['weekends']) || in_array($date, $config['holidays'])) {
        return [
            'date' => $config['show_date'] ? date($config['date_format'], strtotime($date)) : null,
            'time_slots' => [],
            'message' => "No slots available (Weekend or Holiday)"
        ];
    }

    if (isset($config['special_days'][$date])) {
        $config['shifts']['Custom'] = $config['special_days'][$date];
    }

    $output = [];
    if ($config['show_date']) {
        $output['date'] = date($config['date_format'], strtotime($date));
    }

    $output['time_slots'] = [];

    if (empty($config['shifts'])) {
        // If no shifts are defined, generate slots continuously from default working hours
        $config['shifts']['General'] = ['start' => '08:00', 'end' => '18:00'];
    }

    foreach ($config['shifts'] as $shiftName => $shiftTiming) {
        $startTime = strtotime($shiftTiming['start']);
        $endTime = strtotime($shiftTiming['end']);
        $duration = $config['slot_duration'] * 60;
        $padding = $config['slot_padding'] * 60;
        $shiftSlots = [];
        $totalSlots = 0;

        while ($startTime < $endTime) {
            $nextTime = $startTime + $duration;
            if ($nextTime > $endTime) break;

            $formattedSlot = date($config['time_format'], $startTime) . "-" . date($config['time_format'], $nextTime);
            $slotKey = date("H:i", $startTime) . "-" . date("H:i", $nextTime);

            if (isset($config['recurring_blocked_slots'][$dayOfWeek]) && in_array($slotKey, $config['recurring_blocked_slots'][$dayOfWeek])) {
                $startTime = $nextTime + $padding;
                continue;
            }

            $isBreakTime = false;
            foreach ($config['breaks'] as $break) {
                $breakStart = strtotime($break['start']);
                $breakEnd = strtotime($break['end']);
                if (($startTime >= $breakStart && $startTime < $breakEnd) || ($nextTime > $breakStart && $nextTime <= $breakEnd)) {
                    $isBreakTime = true;
                    break;
                }
            }

            $isAvailable = !$isBreakTime && !in_array($slotKey, $bookedSlots) && !in_array($slotKey, $config['custom_blocked_slots']);

            if (isset($config['user_availability'][$user]) && !in_array($slotKey, $config['user_availability'][$user])) {
                $isAvailable = false;
            }

            if (is_callable($config['availability'])) {
                $isAvailable = $config['availability']($slotKey, $date, $bookedSlots);
            }

            $currentTime = strtotime('now'); // Always represents the current time
            $minimumBookingTime = strtotime("+" . $config['minimum_booking_time'] . " hours", $currentTime);
            $slotStartTime = strtotime($date . ' ' . date("H:i", $startTime));

            if ($config['minimum_booking_time'] > 0 && $slotStartTime < $minimumBookingTime) {
                $isAvailable = false;
            }


            if ($config['max_slots_per_day'] !== null && $totalSlots >= $config['max_slots_per_day']) {
                break;
            }

            if (isset($config['priority_users'][$user]) && $config['priority_users'][$user] === true) {
                $isAvailable = true;
            }

            if($config['show_past_slots'] || $isAvailable){
                $shiftSlots[] = [
                    'slot' => $config['show_time'] ? $formattedSlot : null,
                    'available' => $isAvailable
                ];
            }

            $totalSlots++;
            $startTime = $nextTime + $padding;

        }
        if($shiftName == "General"){
            $output['time_slots'] = $shiftSlots;
            continue;
        }
        $output['time_slots'][$shiftName] = $shiftSlots;
    }

    return $output;
}

//example config
$testConfig = [
    "show_time"=>false,
    
    'date' => '2025-03-25',
    'slot_duration' => 30,
    'slot_padding' => 5,
    'shifts' => false,
    'breaks' => [
        ['start' => '10:00', 'end' => '10:15'],
        ['start' => '14:00', 'end' => '14:30']
    ],
    'weekends' => ['Sunday'],
    'holidays' => ['2025-03-27'],
    'custom_blocked_slots' => ['09:00-09:30'],
    'recurring_blocked_slots' => [
        'Monday' => ['08:00-08:30'],
        'Friday' => ['13:30-14:00']
    ],
    'special_days' => [
        '2025-03-28' => ['start' => '07:00', 'end' => '22:00']
    ],
    'user_availability' => [
        'vip_user' => ['08:00-08:30', '09:00-09:30']
    ],
    'minimum_booking_time' => 2, // 2 hours before booking allowed
    'max_slots_per_day' => 10,
    'max_bookings_per_slot' => 2,
    'priority_users' => [
        'vip_user' => true
    ]
];

$bookedSlotsByProject = [
    'default' => ['12:00-12:30', '17:00-17:30']
];

$project = 'default';
$user = 'vip_user';

// $result = generateTimeSlots($testConfig, $bookedSlotsByProject, $project, $user);

// // Print results
// print_r($result);