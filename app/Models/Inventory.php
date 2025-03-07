<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $guarded = [];

    protected $appends = ['formatted_created_at'];

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-m-Y') : '-';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
}
