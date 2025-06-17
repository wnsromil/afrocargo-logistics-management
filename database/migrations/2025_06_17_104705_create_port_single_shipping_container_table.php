<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortSingleShippingContainerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('port_single_shipping_container', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_user_id')->nullable();
            $table->decimal('calculation', 10, 2)->nullable();
            $table->date('calculation_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->unsignedBigInteger('container_size_id')->nullable();
            $table->unsignedBigInteger('port_wise_freights_id')->nullable();
            $table->string('from_country')->nullable();
            $table->string('from_port')->nullable();
            $table->string('to_country')->nullable();
            $table->string('to_port')->nullable();
            $table->decimal('freight_price', 10, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->decimal('used_volume', 10, 2)->nullable();
            $table->decimal('used_weight', 10, 2)->nullable();
            $table->timestamps();

            // Optional: Foreign key constraints
            // $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('container_size_id')->references('id')->on('container_sizes')->onDelete('set null');
            // $table->foreign('port_wise_freights_id')->references('id')->on('port_wise_freights')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_single_shipping_container');
    }
}
