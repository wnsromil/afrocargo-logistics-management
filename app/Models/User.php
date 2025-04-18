<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'warehouse_id',
        'address',
        'name',
        'last_name',
        'email',
        'password',
        'role',
        'role_id',
        'status',
        'phone',
        'phone_2',
        'address',
        'address_2',
        'country_id',
        'state_id',
        'city_id',
        'pincode',
        'is_deleted',
        'vehicle_id',
        'license_number',
        'license_document',
        'license_expiry_date',
        'company_name',
        'apartment',
        'username',
        'latitude',
        'longitude',
        'website_url',
        'write_comment',
        'read_comment',
        'language',
        'year_to_date',
        'signature_date',
        'signature_img',
        'contract_signature_img',
        'profile_pic',
        'country_code_2',
        'country_code',
        'signup_type',
        'invoice_custmore_type',
        'invoice_custmore_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

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
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    protected function profilePic(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url('storage/'.$value):null,
        );
    }
}
