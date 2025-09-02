<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;


class SendFirebaseNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_id;
    public $deviceToken;
    public $title;
    public $body;

    public function __construct($user_id, $deviceToken, $title, $body)
    {
        $this->user_id = $user_id;
        $this->deviceToken = $deviceToken;
        $this->title = $title;
        $this->body = $body;
    }

    public function handle()
    {
        // Call your helper function
        sendFirebaseNotificationSystem($this->deviceToken, $this->title, $this->body);

        User::where('id',   $this->user_id)->increment('notification_read', 1);
    }
}
