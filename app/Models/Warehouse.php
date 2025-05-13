<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
     protected $fillable = [
        'unique_id'
            ];
    //
    protected $guarded=[];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    protected static function booted()
    {
        static::creating(function ($warehouse) {
            // Defaults
            $rolePrefix = 'W';
          
            // Get country ISO based on warehouse_id (if provided)
            $countryIso = 'XX';
            $country = \App\Models\Country::where('name', $warehouse->country_id)->first();
            if ($country && !empty($country->iso2)) {
                $countryIso = strtoupper($country->iso2);
            }
            $fullPrefix = $rolePrefix . $countryIso . '-';
    
            // Get last vehicle with similar prefix
            $lastVehicle = self::where('unique_id', 'like', $rolePrefix . '%')
                ->selectRaw("MAX(CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)) as max_number")
                ->value('max_number') ?? 0;
    
            $newNumber = str_pad($lastVehicle + 1, 6, '0', STR_PAD_LEFT);
    
            $warehouse->unique_id = $fullPrefix . $newNumber;
        });
    }
   
}
