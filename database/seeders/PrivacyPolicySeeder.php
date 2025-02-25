<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivacyPolicy;

class PrivacyPolicySeeder extends Seeder
{
    public function run()
    {
        PrivacyPolicy::create([
            'description' => '<p>This is the privacy policy...</p>',
        ]);
    }
}
