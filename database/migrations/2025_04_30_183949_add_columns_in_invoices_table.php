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
        Schema::table('invoices', function (Blueprint $table) {
            $table->after('generated_by', function (Blueprint $table) {
                $table->unsignedBigInteger('container_id')->nullable();
                $table->unsignedBigInteger('driver_id')->nullable();
                $table->unsignedBigInteger('warehouse_id')->nullable();
                $table->unsignedBigInteger('delivery_address_id')->nullable();
                $table->unsignedBigInteger('pickup_address_id')->nullable();
                $table->decimal('ins', 10, 2)->default(0);
                $table->decimal('discount', 10, 2)->default(0);
                $table->decimal('tax', 10, 2)->default(0);
                $table->decimal('balance', 10, 2)->default(0);
                $table->decimal('total_price', 10, 2)->default(0);

                $table->decimal('payment', 10, 2)->default(0);
                $table->decimal('grand_total', 10, 2)->default(0);

                $table->decimal('total_qty', 10, 2)->default(0);
                $table->json('invoce_item')->nullable();
                $table->string('duedaterange')->nullable();
                $table->dateTime('currentdate')->nullable();
                $table->string('currentTime')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'delivery_address_id',
                'pickup_address_id',
                'ins',
                'discount',
                'tax',
                'balance',
                'total_price',
                'total_qty',
                'invoce_item',
                'duedaterange',
                'currentdate',
                'currentTime',
                'container_id','driver_id','warehouse_id','payment','grand_total'
            ]);
        });
    }
};
