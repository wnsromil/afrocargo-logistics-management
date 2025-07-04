<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BillOfLadingDetail extends Model
{
    //
    protected $guarded = [];

    protected function uniqueId(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?? 'BLD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT),
        );
    }
    

    public function shipperDetails()
    {
        return $this->belongsTo(BillOfLanding::class, 'shipperDetails_id');
    }
    public function consigneeDetails()
    {
        return $this->belongsTo(BillOfLanding::class, 'consigneeDetails_id');
    }
}
