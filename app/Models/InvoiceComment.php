<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceComment extends Model
{
    //
    protected $guarded = [];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
