<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            // RolesAndPermissionsSeeder::class,
            // AdminCredentialSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            DriverInventorySoldSeeder::class,

            // MenuSeeder::class,
            // TermsConditionSeeder::class,
            // PrivacyPolicySeeder::class,
            // AboutUsSeeder::class,
            // SettingsTableSeeder::class
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
