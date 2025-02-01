<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            // USA
            ['name' => 'Los Angeles', 'state_id' => 1],
            ['name' => 'San Francisco', 'state_id' => 1],
            ['name' => 'Houston', 'state_id' => 2],
            ['name' => 'Dallas', 'state_id' => 2],
            ['name' => 'New York City', 'state_id' => 3],
            ['name' => 'Miami', 'state_id' => 4],
            ['name' => 'Chicago', 'state_id' => 5],
            ['name' => 'Cleveland', 'state_id' => 6],
            ['name' => 'Atlanta', 'state_id' => 7],

            // Canada
            ['name' => 'Toronto', 'state_id' => 5],
            ['name' => 'Ottawa', 'state_id' => 5],
            ['name' => 'Montreal', 'state_id' => 6],
            ['name' => 'Vancouver', 'state_id' => 7],
            ['name' => 'Calgary', 'state_id' => 8],
            ['name' => 'Edmonton', 'state_id' => 9],

            // India
            ['name' => 'Mumbai', 'state_id' => 8],
            ['name' => 'Pune', 'state_id' => 8],
            ['name' => 'Bangalore', 'state_id' => 9],
            ['name' => 'Chennai', 'state_id' => 10],
            ['name' => 'Lucknow', 'state_id' => 11],
            ['name' => 'Delhi', 'state_id' => 12],
            ['name' => 'Kolkata', 'state_id' => 13],

            // Nigeria 🇳🇬
            ['name' => 'Lagos City', 'state_id' => 12],
            ['name' => 'Ibadan', 'state_id' => 15],
            ['name' => 'Port Harcourt', 'state_id' => 14],
            ['name' => 'Abuja', 'state_id' => 16],
            ['name' => 'Benin City', 'state_id' => 17],

            // South Africa 🇿🇦
            ['name' => 'Johannesburg', 'state_id' => 16],
            ['name' => 'Pretoria', 'state_id' => 16],
            ['name' => 'Cape Town', 'state_id' => 17],
            ['name' => 'Durban', 'state_id' => 18],
            ['name' => 'Port Elizabeth', 'state_id' => 19],
            ['name' => 'Bloemfontein', 'state_id' => 20],

            // Kenya 🇰🇪
            ['name' => 'Nairobi City', 'state_id' => 19],
            ['name' => 'Mombasa City', 'state_id' => 20],
            ['name' => 'Kisumu City', 'state_id' => 21],
            ['name' => 'Nakuru', 'state_id' => 22],

            // Egypt 🇪🇬
            ['name' => 'Cairo City', 'state_id' => 22],
            ['name' => 'Giza City', 'state_id' => 23],
            ['name' => 'Alexandria City', 'state_id' => 24],
            ['name' => 'Sharm El Sheikh', 'state_id' => 25],

            // Ghana 🇬🇭
            ['name' => 'Accra', 'state_id' => 25],
            ['name' => 'Kumasi', 'state_id' => 26],
            ['name' => 'Tamale', 'state_id' => 27],

            // Ethiopia 🇪🇹
            ['name' => 'Addis Ababa City', 'state_id' => 27],
            ['name' => 'Adama', 'state_id' => 28],
            ['name' => 'Bahir Dar', 'state_id' => 29],

            // Morocco 🇲🇦
            ['name' => 'Casablanca', 'state_id' => 29],
            ['name' => 'Marrakech', 'state_id' => 30],
            ['name' => 'Rabat', 'state_id' => 31],

            // Tanzania 🇹🇿
            ['name' => 'Dar es Salaam City', 'state_id' => 31],
            ['name' => 'Arusha City', 'state_id' => 32],
            ['name' => 'Mwanza', 'state_id' => 33],

            // Australia 🇦🇺
            ['name' => 'Sydney', 'state_id' => 34],
            ['name' => 'Melbourne', 'state_id' => 35],
            ['name' => 'Brisbane', 'state_id' => 36],

            // United Kingdom 🇬🇧
            ['name' => 'London', 'state_id' => 37],
            ['name' => 'Manchester', 'state_id' => 38],
            ['name' => 'Birmingham', 'state_id' => 39],

            // Brazil 🇧🇷
            ['name' => 'São Paulo', 'state_id' => 40],
            ['name' => 'Rio de Janeiro', 'state_id' => 41],
            ['name' => 'Brasília', 'state_id' => 42],
            ['name' => 'Salvador', 'state_id' => 43],
        ];

        City::insert($cities);
    }
}
