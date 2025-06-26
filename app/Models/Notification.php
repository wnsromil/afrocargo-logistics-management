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
        // Get the last notification record with status 'Active', ordered by unique_id
        $lastNotification = Notification::where('status', 'Active')
            ->orderByDesc('unique_id')
            ->first();

        // Get the last number from unique_id (assuming it follows the format "TNT-XXXXXX")
        $lastNumber = 0;
        if ($lastNotification && preg_match('/(\d+)$/', $lastNotification->unique_id, $matches)) {
            $lastNumber = (int)$matches[0];
        }

        // Increment the number for the new unique_id
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        // Return the generated unique_id with TNT- prefix
        return 'TNT-' . $newNumber;
    }
}
