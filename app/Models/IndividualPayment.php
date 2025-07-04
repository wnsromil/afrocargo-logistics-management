<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualPayment extends Model
{
    //
    protected $guarded=[];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
