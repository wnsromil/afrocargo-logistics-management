<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TermsCondition;

class TermsConditionSeeder extends Seeder
{
    public function run()
    {
        TermsCondition::create([
            'description' => '<p>These are the terms and conditions...</p>',
        ]);
    }
}
