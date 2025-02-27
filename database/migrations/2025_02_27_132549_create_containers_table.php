<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wearhouse_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('user_id');
            $table->string('vehicle_type');
            $table->string('vehicle_model');
            $table->year('vehicle_manufactured_year');
            $table->string('seal_no');
            $table->string('container_no_1');
            $table->string('container_no_2');
            $table->string('container_size');
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('containers');
    }
};
