<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;


class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = $this->user;
        $notifications = Notification::where('user_id', $user->id)->get()->map(function ($notification) {
            $notification->created_at_formatted = Carbon::parse($notification->created_at)->format('l \\a\\t h:i A');
            return $notification;
        });
    
        return response()->json([
            'success' => true,
            'data' => $notifications,
            'message' => 'Notification fetch successfully.'
        ]);
    }


}
