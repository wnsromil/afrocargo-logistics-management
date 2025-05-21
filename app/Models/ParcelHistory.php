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

      public function parcelStatus()
    {
        return $this->belongsTo(ParcelStatus::class, 'parcel_status');
    }

    public function setDescriptionAttribute($value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }
        if (!empty($value['customer_subcategories_data']) && is_string($value['customer_subcategories_data'])) {
            $value['customer_subcategories_data'] = json_decode($value['customer_subcategories_data'], true);
        }
        if (!empty($value['driver_subcategories_data']) && is_string($value['driver_subcategories_data'])) {
            $value['driver_subcategories_data'] = json_decode($value['driver_subcategories_data'], true);
        }
        
        $this->attributes['description'] = json_encode($value ?? []);
    }
}
