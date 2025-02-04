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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_capacity')->nullable();
            $table->enum('status', ['Inactive', 'Active'])->default('Active');
        
            // Correct foreign key declaration
            $table->foreign('warehouse_id')
                  ->references('id')
                  ->on('warehouses')
                  ->nullOnDelete(); // Allows NULL when parent warehouse is deleted
        
            $table->timestamps();
        });
        ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
