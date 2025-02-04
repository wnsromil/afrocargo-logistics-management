<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $guarded = [];

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
