<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CustomReport extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'report_date' => 'datetime',
    ];

    protected function uniqueId(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?? 'CR-' . str_pad($this->id, 6, '0', STR_PAD_LEFT),
        );
    }

    public function container()
    {
        return $this->belongsTo(Vehicle::class, 'container_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
