<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'metadata',
    ];

    // protected $casts = [
    //     'metadata' => 'array', // Automatically handle JSON encode/decode
    // ];

    // Optional relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
