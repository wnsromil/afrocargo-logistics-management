<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceHistory extends Model
{
    //
    protected $casts = [
        'histry_info' => 'array',
    ];

    protected $guarded =[];

    public function createdByUser(){
        return $this->belongsTo(User::class,'created_by');
    }
}
