<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    public function run()
    {
        $states = [
            // USA
            ['name' => 'California', 'country_id' => 1],
            ['name' => 'Texas', 'country_id' => 1],
            ['name' => 'New York', 'country_id' => 1],
            ['name' => 'Florida', 'country_id' => 1],
            ['name' => 'Illinois', 'country_id' => 1],
            ['name' => 'Ohio', 'country_id' => 1],

            // Canada
            ['name' => 'Ontario', 'country_id' => 2],
            ['name' => 'Quebec', 'country_id' => 2],
            ['name' => 'British Columbia', 'country_id' => 2],
            ['name' => 'Alberta', 'country_id' => 2],
            ['name' => 'Manitoba', 'country_id' => 2],

            // India
            ['name' => 'Maharashtra', 'country_id' => 3],
            ['name' => 'Karnataka', 'country_id' => 3],
            ['name' => 'Tamil Nadu', 'country_id' => 3],
            ['name' => 'Uttar Pradesh', 'country_id' => 3],
            ['name' => 'Delhi', 'country_id' => 3],
            ['name' => 'West Bengal', 'country_id' => 3],
            ['name' => 'Gujarat', 'country_id' => 3],

            // Nigeria 🇳🇬
            ['name' => 'Lagos', 'country_id' => 4],
            ['name' => 'Kano', 'country_id' => 4],
            ['name' => 'Rivers', 'country_id' => 4],
            ['name' => 'Oyo', 'country_id' => 4],
            ['name' => 'Abuja', 'country_id' => 4],

            // South Africa 🇿🇦
            ['name' => 'Gauteng', 'country_id' => 5],
            ['name' => 'Western Cape', 'country_id' => 5],
            ['name' => 'KwaZulu-Natal', 'country_id' => 5],
            ['name' => 'Eastern Cape', 'country_id' => 5],
            ['name' => 'Limpopo', 'country_id' => 5],

            // Kenya 🇰🇪
            ['name' => 'Nairobi', 'country_id' => 6],
            ['name' => 'Mombasa', 'country_id' => 6],
            ['name' => 'Kisumu', 'country_id' => 6],
            ['name' => 'Nakuru', 'country_id' => 6],
            ['name' => 'Eldoret', 'country_id' => 6],

            // Egypt 🇪🇬
            ['name' => 'Cairo', 'country_id' => 7],
            ['name' => 'Giza', 'country_id' => 7],
            ['name' => 'Alexandria', 'country_id' => 7],
            ['name' => 'Luxor', 'country_id' => 7],

            // Ghana 🇬🇭
            ['name' => 'Greater Accra', 'country_id' => 8],
            ['name' => 'Ashanti', 'country_id' => 8],
            ['name' => 'Western', 'country_id' => 8],
            ['name' => 'Central', 'country_id' => 8],

            // Ethiopia 🇪🇹
            ['name' => 'Addis Ababa', 'country_id' => 9],
            ['name' => 'Oromia', 'country_id' => 9],
            ['name' => 'Amhara', 'country_id' => 9],
            ['name' => 'Tigray', 'country_id' => 9],

            // Morocco 🇲🇦
            ['name' => 'Casablanca-Settat', 'country_id' => 10],
            ['name' => 'Marrakech-Safi', 'country_id' => 10],
            ['name' => 'Fès-Meknès', 'country_id' => 10],
            ['name' => 'Rabat-Salé-Kénitra', 'country_id' => 10],

            // Tanzania 🇹🇿
            ['name' => 'Dar es Salaam', 'country_id' => 11],
            ['name' => 'Arusha', 'country_id' => 11],
            ['name' => 'Mwanza', 'country_id' => 11],
            ['name' => 'Mbeya', 'country_id' => 11],

            // Australia 🇦🇺
            ['name' => 'New South Wales', 'country_id' => 12],
            ['name' => 'Queensland', 'country_id' => 12],
            ['name' => 'Victoria', 'country_id' => 12],
            ['name' => 'Western Australia', 'country_id' => 12],

            // United Kingdom 🇬🇧
            ['name' => 'England', 'country_id' => 13],
            ['name' => 'Scotland', 'country_id' => 13],
            ['name' => 'Wales', 'country_id' => 13],
            ['name' => 'Northern Ireland', 'country_id' => 13],

            // Brazil 🇧🇷
            ['name' => 'São Paulo', 'country_id' => 14],
            ['name' => 'Rio de Janeiro', 'country_id' => 14],
            ['name' => 'Minas Gerais', 'country_id' => 14],
            ['name' => 'Bahia', 'country_id' => 14],
        ];

        State::insert($states);
    }
}
