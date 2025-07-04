<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BillOfLanding extends Model
{
    protected $guarded = [];
    

    protected function uniqueId(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?? 'TBL-' . str_pad($this->id, 6, '0', STR_PAD_LEFT),
        );
    }
    
}
