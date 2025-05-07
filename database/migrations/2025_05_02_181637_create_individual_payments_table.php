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
        Schema::create('individual_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('personal')->nullable(); // driver or representative name/id
            $table->string('currency');
            $table->enum('payment_type', ['boxcredit', 'cash', 'cheque', 'CreditCard']);
            $table->decimal('payment_amount', 10, 2);
            $table->string('reference')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('invoice_amount', 10, 2);
            $table->decimal('total_balance', 10, 2);
            $table->decimal('exchange_rate_balance', 10, 2)->nullable();
            $table->decimal('applied_payments', 10, 2)->nullable();
            $table->decimal('applied_total_usd', 10, 2)->nullable();
            $table->decimal('current_balance', 10, 2)->nullable();
            $table->decimal('exchange_rate', 10, 2)->nullable();
            $table->decimal('balance_after_exchange_rate', 10, 2)->nullable();
            $table->dateTime('payment_date');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individual_payments');
    }
};
