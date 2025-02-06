<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParcelHistory extends Model
{
    //
    protected $guarded =[];

    protected $casts =[
        'description'=>'object'
    ];

    public function createdbyUser(){
        return $this->belongsTo(User::class,'created_user_id')->select('id','name','role','role_id');
    }

    public function customer(){
        return $this->belongsTo(User::class,'customer_id')->select('id','name','role','role_id');
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function parcel(){
        return $this->belongsTo(Parcel::class,'parcel_id');
    }
}
