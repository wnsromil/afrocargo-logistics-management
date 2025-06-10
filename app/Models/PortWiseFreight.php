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

    public function fromPort()
    {
        return $this->hasOne(Port::class, 'id', 'from_port');
    }

    public function toPort()
    {
        return $this->hasOne(Port::class, 'id', 'to_port');
    }
}
