<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    //
    use HasFactory;

    // ✅ Mass Assignment ke liye allowed fields
    protected $fillable = [
        'address',
        'address_type',
        'alternative_mobile_number',
        'city_id',
        'country_id',
        'full_name',
        'mobile_number',
        'pincode',
        'state_id',
        'user_id',
        'warehouse_id'
    ];
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
