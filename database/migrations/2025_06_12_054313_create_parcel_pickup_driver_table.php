<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parcel_pickup_driver', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parcel_id');
            $table->string('item_name');
            $table->string('img')->nullable(); // image ka path store karne ke liye
            $table->integer('quantity')->nullable();
            $table->string('quantity_type')->nullable();;
            $table->enum('is_deleted', ['Yes', 'No'])->default('No');
            $table->unsignedBigInteger('driver_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcel_pickup_driver');
    }
};
