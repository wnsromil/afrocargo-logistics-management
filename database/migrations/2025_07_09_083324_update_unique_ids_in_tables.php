<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vehicles table
        DB::statement("
        UPDATE vehicles
        SET unique_id = CONCAT(
            SUBSTRING_INDEX(unique_id, '-', 1),
            '-', 
            CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(unique_id, '-', 2), '-', -1) AS UNSIGNED),
            CASE
                WHEN unique_id LIKE '%-%-%' THEN CONCAT('-', SUBSTRING_INDEX(unique_id, '-', -1))
                ELSE ''
            END
        )
        WHERE unique_id REGEXP '^[A-Z]+-[0]*[1-9][0-9]*(-[0-9]+)?$'
    ");

        // Inventories table
        DB::statement("
        UPDATE inventories
        SET unique_id = CONCAT(
            SUBSTRING_INDEX(unique_id, '-', 1),
            '-',
            CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)
        )
        WHERE unique_id REGEXP '^[A-Z]+-[0]*[1-9][0-9]*$'
    ");

        // Expenses table
        DB::statement("
        UPDATE expenses
        SET unique_id = CONCAT(
            SUBSTRING_INDEX(unique_id, '-', 1),
            '-',
            CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)
        )
        WHERE unique_id REGEXP '^[A-Z]+-[0]*[1-9][0-9]*$'
    ");

        // Notifications table
        DB::statement("
        UPDATE notifications
        SET unique_id = CONCAT(
            SUBSTRING_INDEX(unique_id, '-', 1),
            '-',
            CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)
        )
        WHERE unique_id REGEXP '^[A-Z]+-[0]*[1-9][0-9]*$'
    ");

        // Users table
        DB::statement("
        UPDATE users
        SET unique_id = CONCAT(
            SUBSTRING_INDEX(unique_id, '-', 1),
            '-',
            CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)
        )
        WHERE unique_id REGEXP '^[A-Z]+-[0]*[1-9][0-9]*$'
    ");

     DB::statement("
        UPDATE warehouses
        SET unique_id = CONCAT(
            SUBSTRING_INDEX(unique_id, '-', 1),
            '-',
            CAST(SUBSTRING_INDEX(unique_id, '-', -1) AS UNSIGNED)
        )
        WHERE unique_id REGEXP '^[A-Z]+-[0]*[1-9][0-9]*$'
    ");
    }

    public function down(): void
    {
        // No rollback, as we are modifying existing data irreversibly
        // You can implement backup logic here if needed
        // Example: Copy data to *_backup tables before running this
    }
};
