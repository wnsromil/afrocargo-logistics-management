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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')
                  ->on('categories')->onDelete('cascade');
                  
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
      
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->integer('total_quantity')->default(0);
            $table->integer('in_stock_quantity')->default(0);
            $table->integer('low_stock_warning')->default(10);
            $table->enum('stock_status',['In Stock','Out Stock'])->defualt('In Stock');
            $table->enum('status', ['Inactive', 'Active','Created','Updated'])->default('created')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
