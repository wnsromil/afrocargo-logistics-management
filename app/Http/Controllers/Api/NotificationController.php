<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;


class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $notifications = Notification::latest()->where('status', 'Active')->get()->map(function ($notification) {
            $notification->time_ago = $notification->created_at->diffForHumans();
            return $notification;
        });

        return response()->json([
            'success' => true,
            'data' => $notifications,
            'message' => 'All notifications fetched successfully.'
        ]);
    }

    public function markAsReadNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->notification_read = 0;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Notifications marked as read.'
        ]);
    }
}
