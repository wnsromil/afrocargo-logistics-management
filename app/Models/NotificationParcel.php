<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationParcel extends Model
{
    use HasFactory;

    protected $table = 'notification_parcel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'message',
        'user_id',
        'parcel_id',
        'notification_parcel_message_id',
        'type',
    ];

    /**
     * Relationships (optional)
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function notificationParcelMessage()
    {
        return $this->belongsTo(NotificationParcelMessage::class);
    }
}
