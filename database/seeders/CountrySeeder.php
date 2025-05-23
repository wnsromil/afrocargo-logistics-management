<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    public function run()
    {
        // $queries = [
        //     'ALTER TABLE `addresses` DROP FOREIGN KEY `addresses_country_id_foreign`',
        //     'ALTER TABLE `addresses` DROP FOREIGN KEY `addresses_state_id_foreign`',
        //     'ALTER TABLE `addresses` DROP FOREIGN KEY `addresses_city_id_foreign`',
        //     'ALTER TABLE `addresses` MODIFY `country_id` INT UNSIGNED',
        //     'ALTER TABLE `addresses` MODIFY `state_id` INT UNSIGNED',
        //     'ALTER TABLE `addresses` MODIFY `city_id` INT UNSIGNED',
        // ];

        // foreach ($queries as $query) {
        //     DB::statement($query);
        // }

         DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            // \App\Models\City::truncate();
            // \App\Models\State::truncate();
            // \App\Models\Country::truncate();
            
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Load and execute the SQL file first
        $sql = File::get(database_path('seeders/sql/countries.sql'));
        DB::unprepared($sql);

        // Then alter the addresses table
        DB::statement("ALTER TABLE addresses MODIFY country_id BIGINT UNSIGNED");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}



