<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'title',
        'message',
        'notification_for',
        'notification_datetime',
        'status',
        'type',
        'user_id',
        'img',
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($notification) {
            // Generate unique_id when creating a new notification
            $notification->unique_id = self::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        // Get the last notification with numeric sorting of unique_id
        $lastNotification = Notification::where('status', 'Active')
            ->selectRaw("CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED) as number_part")
            ->orderByDesc('number_part')
            ->first();

        $lastNumber = $lastNotification ? (int) $lastNotification->number_part : 0;

        // No zero-padding
        $newNumber = (string) ($lastNumber + 1);

        // Return the generated unique_id with TNT- prefix
        return 'TNT-' . $newNumber;
    }
}
