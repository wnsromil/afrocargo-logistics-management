<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //

    protected $guarded = [];

    public function products(){
        return $this->hasOne(Inventory::class,'id','product_id')->with(['category'=>function($q){
            return $q->select('id','name');
        }]);
    }
}
