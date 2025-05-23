<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeeklySchedulesToAvailabilitiesAndAvailabilityIdToWeeklySchedules extends Migration
{
    public function up()
    {
        // availabilities table me enum column add karna
        Schema::table('availabilities', function (Blueprint $table) {
            $table->enum('weeklySchedules', ['Yes', 'No'])->default('No')->after('is_active');
        });

        // weekly_schedules table me availability_id column add karna
        Schema::table('weekly_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('availability_id')->nullable()->after('user_id');

            // Foreign key constraint
            $table->foreign('availability_id')->references('id')->on('availabilities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->dropColumn('weeklySchedules');
        });

        Schema::table('weekly_schedules', function (Blueprint $table) {
            $table->dropForeign(['availability_id']);
            $table->dropColumn('availability_id');
        });
    }
}
