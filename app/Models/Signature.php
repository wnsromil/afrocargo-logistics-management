<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'signature_name',
        'signature_file',
        'creator_user_id',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

     protected function signatureFile(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url($value) : null,
        );
    }
}
