<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('container_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('container_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('arrived_warehouse_id')->nullable();
            $table->date('transfer_date');
            $table->integer('no_of_orders');
            $table->unsignedBigInteger('driver_id');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('partial_payment', 10, 2)->default(0);
            $table->decimal('remaining_payment', 10, 2)->default(0);
            $table->string('status')->nullable();
            $table->longText('description')->nullable();
            $table->longText('note')->nullable();
            $table->enum('type', ['Transfer', 'Arrived']);
            $table->timestamps();

            // Optional: Foreign key constraints (if tables exist)
            // $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            // $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('container_history');
    }
};
