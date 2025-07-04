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
        Schema::create('custom_invoice_reports', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('batch_package_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('cedula')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('province')->nullable();
            $table->text('invoice_detail')->nullable();
            $table->string('receiver_tel_number_country_code')->nullable();
            $table->string('receiver_tel_number_dial_code')->nullable();
            $table->string('receiver_tel_number')->nullable();
            $table->string('customer_tel_number_country_code')->nullable();
            $table->string('customer_tel_number_dial_code')->nullable();
            $table->string('customer_tel_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_invoice_reports');
    }
};
