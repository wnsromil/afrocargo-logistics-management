<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortWiseFreight extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'creator_user_id',
        'from_country',
        'from_port',
        'to_country',
        'to_port',
    ];
}
