<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\NotificationParcel;
use Carbon\Carbon;


class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {

        $defaultImage = 'https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg';

        // Get from Notification
        $user = auth()->user();
        $roleId = $user->role_id;
        $userId = $user->id;

        $notifications = Notification::where('status', 'Active')
            ->where(function ($query) use ($roleId, $userId, $user) {
                $query->where('notification_for', 'All');

                if ($roleId == 3) {
                    $query->orWhere(function ($q) use ($user) {
                        $q->where('notification_for', 'All Warehouse Customers')
                            ->where('warehouse_id', $user->warehouse_id); // ✅ warehouse check added
                    });
                } elseif ($roleId == 4) {
                    $query->orWhere(function ($q) use ($user) {
                        $q->where('notification_for', 'All Warehouse Drivers')
                            ->where('warehouse_id', $user->warehouse_id); // ✅ warehouse check added
                    });
                }

                // Always include personal notifications
                $query->orWhere('user_id', $userId);
            })
            ->get()
            ->map(function ($notification) use ($defaultImage) {
                return [
                    'id' => $notification->id,
                    'parcel_id' => null,
                    'type' => $notification->type ?? 'general',
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'created_at' => $notification->created_at,
                    'time_ago' => $notification->created_at->diffForHumans(),
                    'image' => $defaultImage,
                ];
            });


        // Get from NotificationParcel
        $parcelNotifications = NotificationParcel::where('user_id', $userId)
            ->get()
            ->map(function ($notification) use ($defaultImage) {
                return [
                    'id' => $notification->id,
                    'parcel_id' => $notification->parcel_id,
                    'type' => 'Parcel',
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'created_at' => $notification->created_at,
                    'time_ago' => $notification->created_at->diffForHumans(),
                    'image' => $defaultImage,
                ];
            });

        // Merge and sort
        $allNotifications = $notifications
            ->merge($parcelNotifications)
            ->sortByDesc('created_at')
            ->values(); // reset keys

        return response()->json([
            'success' => true,
            'data' => $allNotifications,
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
