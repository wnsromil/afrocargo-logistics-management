<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $notifications = [
            [
                'title' => 'New Update Available',
                'description' => 'A new system update is available. Please check your settings.',
                'read_only' => false,
                'type' => 'info',
                'user_id' => 41,
            ],
            [
                'title' => 'Payment Reminder',
                'description' => 'Your payment is due in 3 days. Please complete the transaction.',
                'read_only' => false,
                'type' => 'alert',
                'user_id' => 40,
            ],
            [
                'title' => 'Welcome Message',
                'description' => 'Welcome to our platform! We are glad to have you.',
                'read_only' => true,
                'type' => 'general',
                'user_id' => 41,
            ]
        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}

