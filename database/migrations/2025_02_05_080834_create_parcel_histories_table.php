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
        Schema::create('parcel_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcel_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreignId('warehouse_id')->nullable()->constrained()->nullOnDelete();
            $table->string('parcel_status');
            $table->string('status');
            $table->json('description');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')
            ->on('users')->nullOnDelete();
            $table->foreign('created_user_id')->references('id')
            ->on('users')->nullOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcel_histories');
    }
};
