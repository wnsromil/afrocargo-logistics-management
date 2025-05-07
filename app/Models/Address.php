<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    //
    use HasFactory;

    // ✅ Mass Assignment ke liye allowed fields
    protected $guarded = [];
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id')->select([
            "id","name","last_name","profile_pic","unique_id",
            "email","phone","address","address_2",
            "country_id","state_id","city_id","pincode",
            "warehouse_id","role","role_id",
            "latitude","longitude","created_at"
        ]);
    }
}
