<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateDayEnumInWeeklySchedulesTable extends Migration
{


    
    public function up(): void
    {
        DB::statement("ALTER TABLE weekly_schedules MODIFY COLUMN day ENUM(
            'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'
        ) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE weekly_schedules MODIFY COLUMN day ENUM(
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
        ) NOT NULL");
    }
}
