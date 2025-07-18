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
        'invoice_custmore_id',
        'phone_code_id',
        'phone_2_code_id_id',
        'parent_customer_id',
        'unique_id',
        'created_by_id',
        'contract',
        'text_cust',
        'voice_call',
        'cash_cust',
        'is_license_pic',
        'no_service',
        'call',
        'sales_call',
        'notification_read'
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
    public function parent_customer()
    {
        return $this->belongsTo(User::class, 'parent_customer_id');
    }
    public function phone_code()
    {
        return $this->belongsTo(Country::class, 'phone_code_id');
    }

    public function phone_2_code()
    {
        return $this->belongsTo(Country::class, 'phone_2_code_id_id');
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

    public function invoiceCustmore()
    {
        return $this->belongsTo(User::class, 'invoice_custmore_id');
    }

    public function container()
    {
        return $this->hasOne(Vehicle::class, 'vehicle_id'); // ya hasMany agar ek se zyada ho
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'user_id');
    }
    public function weeklySchedules()
    {
        return $this->hasMany(WeeklySchedule::class, 'user_id');
    }
    public function locationSchedules()
    {
        return $this->hasMany(LocationSchedule::class, 'user_id');
    }
    public function addresses()
    {
        return $this->hasOne(Address::class, 'user_id');
    }
    public function addrs()
    {
        return $this->hasMany(Address::class);
    }
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Address::class, 'user_id')->where('default_address', 'Yes')->with('user');
    }

    protected function profilePic(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url('storage/' . $value) : null,
        );
    }

    protected function licenseDocument(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url('storage/' . $value) : null,
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => trim($this->name . ' ' . $this->last_name)
        );
    }

    public static function generateUniqueId($role_id, $country_id = null, $warehouse_id = null)
    {
        if (empty($role_id)) {
            $role_id = 3;
        }

        // Default country iso2
        $countryIso = 'XX';

        if (!empty($country_id)) {
            $country = \App\Models\Country::where('name', $country_id)->first();
            if ($country && !empty($country->iso2)) {
                $countryIso = strtoupper($country->iso2);
            }
        }

        // Role-wise prefix
        $rolePrefix = '';
        $fullPrefix = '';
        switch ($role_id) {
            case 2:
                $rolePrefix = 'WM';
                $fullPrefix = 'WM' . $countryIso . '-';
                break;
            case 3:
                $rolePrefix = 'C';
                $fullPrefix = 'C' . $countryIso . '-';
                break;
            case 4:
                $rolePrefix = 'D';
                $fullPrefix = 'D' . $countryIso . '-';
                break;
            case 5:
                $rolePrefix = 'S';
                $fullPrefix = 'S' . $countryIso . '-';
                break;
            case 6:
                $rolePrefix = 'P';
                $fullPrefix = 'P' . $countryIso . '-';
                break;
            default:
                $rolePrefix = 'C';
                $fullPrefix = 'C' . $countryIso . '-';
                break;
        }

        // Find last used number
        $lastNumber = User::where('unique_id', 'like', $rolePrefix . '%')
            ->selectRaw("MAX(CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)) as max_number")
            ->value('max_number') ?? 0;

        $newNumber = (string) ($lastNumber + 1); // ✅ zero-free number

        return $fullPrefix . $newNumber;
    }

    public function shipToAddress()
    {
        return $this->hasMany(User::class, 'invoice_custmore_id')->with('defaultAddress');
    }



    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->unique_id = self::generateUniqueId($user->role_id, $user->country_id);
        });
    }
}
