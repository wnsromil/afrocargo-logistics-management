<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        // Weight-based pricing
        DB::table('settings')->insert([
            'parent_id' => null,
            'key' => 'weight_rate',
            'value' => '100', // ₹100 per 10kg
            'type' => 'number',
            'default_value' => '100',
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'parent_id' => null,
            'key' => 'weight_unit',
            'value' => '10', // 10kg unit
            'type' => 'number',
            'default_value' => '10',
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Distance-based pricing
        DB::table('settings')->insert([
            'parent_id' => null,
            'key' => 'distance_rate',
            'value' => '100', // ₹100 per 4km
            'type' => 'number',
            'default_value' => '100',
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'parent_id' => null,
            'key' => 'distance_unit',
            'value' => '4', // 4km unit
            'type' => 'number',
            'default_value' => '4',
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
