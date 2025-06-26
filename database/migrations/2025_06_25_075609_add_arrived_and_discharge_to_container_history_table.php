<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('container_history', function (Blueprint $table) {
            $table->enum('arrived_container', ['Yes', 'No'])->default('No')->after('id');
            $table->enum('full_discharge', ['Yes', 'No'])->default('No')->after('arrived_container');
        });
    }

    public function down(): void
    {
        Schema::table('container_history', function (Blueprint $table) {
            $table->dropColumn(['arrived_container', 'full_discharge']);
        });
    }
};
