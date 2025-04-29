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

    public function availabilities(){
        return $this->hasMany(Availability::class, 'user_id');
    }
    public function weeklySchedules(){
        return $this->hasMany(WeeklySchedule::class, 'user_id');
    }
    public function locationSchedules(){
        return $this->hasMany(LocationSchedule::class, 'user_id');
    }

    protected function profilePic(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value) ? url('storage/' . $value) : null,
        );
    }
    


    public static function generateUniqueId($role_id)
    {
        // Set the prefix based on the role_id
        if (empty($role_id)) {
            $role_id = 3;  // Default role_id is 3 (CUS-)
        }

        // Set the prefix based on the role_id
        $prefix = '';
        switch ($role_id) {
            case 2:
                $prefix = 'WMUS-';
                break;
            case 3:
                $prefix = 'CUS-';
                break;
            case 4:
                $prefix = 'DUS-';
                break;
                // Add other cases if needed
        }

        // If no valid prefix is set, default to 'CUS-'
        if (empty($prefix)) {
            $prefix = 'CUS-';
        }

        // Get the last row with this role_id, ordered by unique_id
        $lastUser = User::where('role_id', $role_id)
            ->orderByDesc('unique_id') // Order by unique_id in descending order
            ->first();

        // If there are no existing users for this role_id, start from 1
        $lastNumber = 0;
        if ($lastUser && preg_match('/(\d+)$/', $lastUser->unique_id, $matches)) {
            $lastNumber = (int)$matches[0];
        }

        // Increment the number for the new unique_id
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);

        // Return the generated unique_id
        return $prefix . $newNumber;
    }

    /**
     * Overriding the create method to automatically assign unique_id.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Generate unique_id when creating a new user based on their role_id
            // This will not throw an error if no users exist for the role_id
            $user->unique_id = self::generateUniqueId($user->role_id);
        });
    }
}
