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
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mobile_number_code()
    {
        return $this->belongsTo(Country::class, 'mobile_number_code_id');
    }

    public function alternative_mobile_number_code()
    {
        return $this->belongsTo(Country::class, 'alternative_mobile_number_code_id');
    }
}
