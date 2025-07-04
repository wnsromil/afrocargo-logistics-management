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
        Schema::dropIfExists('barcodes');

        
        Schema::create('barcodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('parcel_id')->nullable();
            $table->unsignedBigInteger('supply_id')->nullable();
            $table->string('description')->nullable(); // Optional description for the barcode
            $table->string('type')->default('Barcode');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
        });

        Schema::table('barcodes', function (Blueprint $table) {
            //
            $table->text('barcode')->nullable();
            $table->string('barcode_code')->after('barcode')->nullable();
            $table->string('pacage_type')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barcodes', function (Blueprint $table) {
            //
            $table->dropColumn(['barcode_code','pacage_type']);
            $table->string('barcode')->change();
        });
    }
};
