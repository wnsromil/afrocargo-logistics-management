<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        AboutUs::create([
            'description' => 'This is the About Us description for our company.'
        ]);
    }
}
