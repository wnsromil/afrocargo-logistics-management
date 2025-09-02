<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


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

    protected static function booted()
    {
        static::creating(function ($address) {
            // Set prefix based on address_type
            $rolePrefix = null;

            if ($address->address_type === 'pickup') {
                $rolePrefix = 'P';
            } elseif ($address->address_type === 'delivery') {
                $rolePrefix = 'S';
            }

            // If address_type is neither pickup nor delivery, don't set unique_id
            if (!$rolePrefix) {
                $address->unique_id = null;
                return;
            }

            // Default country ISO
            $countryIso = 'XX';
            $country = \App\Models\Country::where('name', $address->country_id)->first();
            if ($country && !empty($country->iso2)) {
                $countryIso = strtoupper($country->iso2);
            }

            $fullPrefix = $rolePrefix . $countryIso . '-';

            // 👉 Only filter by rolePrefix (P or S), ignore country for counting
            $lastId = self::where('unique_id', 'like', $rolePrefix . '%')
                ->selectRaw("MAX(CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)) as max_number")
                ->value('max_number') ?? 0;

            $newNumber = (string) ($lastId + 1);

            $address->unique_id = $fullPrefix . $newNumber;
        });
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? "{$this->name} {$this->last_name}" : $value,
        );
    }
}
