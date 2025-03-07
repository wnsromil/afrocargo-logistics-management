<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'user_id' => 1,
                'mobile_number' => '9876543210',
                'alternative_mobile_number' => '9876543211',
                'address' => '123 Street, City Area',
                'pincode' => '110001',
                'country_id' => 1,
                'state_id' => 1,
                'city_id' => 1,
                'address_type' => 'pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'mobile_number' => '9876543212',
                'alternative_mobile_number' => '9876543213',
                'address' => '456 Street, Another Area',
                'pincode' => '110002',
                'country_id' => 1,
                'state_id' => 1,
                'city_id' => 2,
                'address_type' => 'delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'mobile_number' => '9876543214',
                'alternative_mobile_number' => '9876543215',
                'address' => '789 Street, Some Area',
                'pincode' => '110003',
                'country_id' => 1,
                'state_id' => 1,
                'city_id' => 3,
                'address_type' => 'pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'mobile_number' => '9876543216',
                'alternative_mobile_number' => '9876543217',
                'address' => '101 Street, Old Area',
                'pincode' => '110004',
                'country_id' => 1,
                'state_id' => 1,
                'city_id' => 4,
                'address_type' => 'delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'mobile_number' => '9876543218',
                'alternative_mobile_number' => '9876543219',
                'address' => '202 Street, Modern Area',
                'pincode' => '110005',
                'country_id' => 1,
                'state_id' => 1,
                'city_id' => 5,
                'address_type' => 'pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
