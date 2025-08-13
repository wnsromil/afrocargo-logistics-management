<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_stripe_transactions_table.php
    public function up()
    {
        Schema::create('stripe_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->string('status');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_id')->nullable();;
            $table->string('order_type')->nullable();;
            $table->string('email')->nullable();
            $table->string('payment_method')->nullable();
            $table->json('raw_data'); // Full raw Stripe object
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_transactions');
    }
};
