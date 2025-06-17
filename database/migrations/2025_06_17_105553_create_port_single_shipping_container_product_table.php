<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortSingleShippingContainerProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('port_single_shipping_container_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('port_single_shipping_container_id')->nullable();
            $table->string('product_name')->nullable();
            $table->text('description')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->string('dimensions_in')->nullable(); // e.g., 'cm' or 'inch'
            $table->decimal('breadth', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->string('product_weight_type')->nullable(); // e.g., 'kg', 'g', etc.
            $table->decimal('product_weight', 10, 2)->nullable();
            $table->integer('qty_pack')->nullable();
            $table->string('packing_weight_type')->nullable(); // e.g., 'kg', 'g', etc.
            $table->decimal('packing_weight', 10, 2)->nullable();
            $table->integer('total_cartons')->nullable();
            $table->decimal('single_CBM', 10, 3)->nullable();
            $table->decimal('total_CBM', 10, 3)->nullable();
            $table->decimal('net_weight_kg', 10, 2)->nullable();
            $table->decimal('gross_weight_kg', 10, 2)->nullable();
            $table->decimal('total_net_weight_kg', 10, 2)->nullable();
            $table->decimal('total_gross_weight_kg', 10, 2)->nullable();
            $table->timestamps();

            // Optional foreign key
            // $table->foreign('port_single_shipping_container_id')->references('id')->on('port_single_shipping_container')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_single_shipping_container_product');
    }
}
