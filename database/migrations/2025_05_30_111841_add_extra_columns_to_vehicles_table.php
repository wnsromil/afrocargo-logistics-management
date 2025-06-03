<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('trucking_company')->nullable();
            $table->date('container_in_date')->nullable();
            $table->time('container_in_time')->nullable();
            $table->date('container_out_date')->nullable();
            $table->time('container_out_time')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('vessel_voyage')->nullable();
            $table->string('tir_number')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'trucking_company',
                'container_in_date',
                'container_in_time',
                'container_out_date',
                'container_out_time',
                'chassis_number',
                'vessel_voyage',
                'tir_number',
            ]);
        });
    }
};
