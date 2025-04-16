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
        Schema::create('weekly_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
            // Fix: Typo in bigInteger and default
            $table->bigInteger('creates_by')->nullable();
        
            // Add enum for days of the week
            $table->enum('day', [
                'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
            ])->nullable();
        
            $table->time('morning_start')->nullable();
            $table->time('morning_end')->nullable();
            $table->time('afternoon_start')->nullable();
            $table->time('afternoon_end')->nullable();
            $table->time('evening_start')->nullable();
            $table->time('evening_end')->nullable();
        
            // Fix: Typo in "default"
            $table->integer('is_active')->default(1);
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_schedules');
    }
};
