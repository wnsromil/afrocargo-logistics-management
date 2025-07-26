<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationParcelMessage extends Model
{
    protected $table = 'notification_parcel_message';

    protected $fillable = [
        'title',
        'message',
        'status',
        'type',
    ];
}
