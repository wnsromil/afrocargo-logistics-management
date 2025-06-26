<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    //

    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
