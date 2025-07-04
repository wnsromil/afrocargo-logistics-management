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
        Schema::create('barcodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('parcel_id')->nullable();
            $table->unsignedBigInteger('supply_id')->nullable();
            $table->string('barcode')->unique(); // Unique barcode string
            $table->string('description')->nullable(); // Optional description for the barcode
            $table->string('type')->default('Barcode');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barcodes');
    }
};
