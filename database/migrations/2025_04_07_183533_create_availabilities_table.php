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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
            // Corrected 'bigInteger' and 'nullable'
            $table->bigInteger('creates_by')->nullable();
        
            // Corrected 'nullable' typos
            $table->string('lat')->nullable();  
            $table->string('lng')->nullable();  
            $table->text('address')->nullable();
        
            $table->date('date')->nullable();
        
            // Default availability flags
            $table->integer('morning')->default(1);
            $table->integer('afternoon')->default(1);
            $table->integer('evening')->default(1);
        
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
