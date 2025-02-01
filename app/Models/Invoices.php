<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    //
    protected $guarded=[];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
