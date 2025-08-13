<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRewardFieldsToIndividualPaymentsAndUsers extends Migration
{
    public function up()
    {
        // Add reward_count to individual_payments
        Schema::table('individual_payments', function (Blueprint $table) {
            $table->enum('reward_count', ['Yes', 'No'])->default('No');
        });

        // Add reward_point to users
        Schema::table('users', function (Blueprint $table) {
            $table->integer('reward_point', 8, 2)->default(0.00);
        });
    }

    public function down()
    {
        // Remove reward_count from individual_payments
        Schema::table('individual_payments', function (Blueprint $table) {
            $table->dropColumn('reward_count');
        });

        // Remove reward_point from users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reward_point');
        });
    }
}
