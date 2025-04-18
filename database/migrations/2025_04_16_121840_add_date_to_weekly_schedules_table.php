<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToWeeklySchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('weekly_schedules', function (Blueprint $table) {
            // Adding a new date column
            $table->date('date')->nullable();  // Use 'nullable' if the date can be empty
        });
    }

    public function down()
    {
        Schema::table('weekly_schedules', function (Blueprint $table) {
            // Drop the date column if rolling back
            $table->dropColumn('date');
        });
    }
}
