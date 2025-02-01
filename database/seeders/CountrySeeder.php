<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'United States'],
            ['name' => 'Canada'],
            ['name' => 'India'],
            ['name' => 'Nigeria'],
            ['name' => 'South Africa'],
            ['name' => 'Kenya'],
            ['name' => 'Egypt'],
            ['name' => 'Ghana'],
            ['name' => 'Ethiopia'],
            ['name' => 'Morocco'],
            ['name' => 'Tanzania']
        ];

        Country::insert($countries);
    }
}



