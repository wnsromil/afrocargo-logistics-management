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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('total_quantity')->default(0);
            $table->integer('in_stock_quantity')->default(0);
            $table->integer('low_stock_warning')->default(10);
            $table->enum('stock_status',['In Stock','Out Stock'])->defualt('In Stock');
            $table->enum('status', ['Inactive', 'Active'])->default('Active')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')
            ->on('categories')->nullOnDelete();
            $table->foreign('warehouse_id')->references('id')
            ->on('warehouses')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
