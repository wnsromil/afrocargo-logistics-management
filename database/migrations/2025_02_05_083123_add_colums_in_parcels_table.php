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
        Schema::table('parcels', function (Blueprint $table) {
            //
            
            $table->after('warehouse_id',function()use($table){
                $table->json('parcel_car_ids')->nullable();
                $table->decimal('weight', 10, 2)->default(0.00);
                $table->decimal('total_amount', 10, 2)->default(0.00);
                $table->decimal('partial_payment', 10, 2)->default(0.00);
                $table->decimal('remaining_payment', 10, 2)->default(0.00);
                $table->enum('payment_type',['COD','Online','Cash'])->default('Online');
                $table->text('descriptions')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
            $table->dropColumn('weight');
            $table->dropColumn('total_amount');
            $table->dropColumn('partial_payment');
            $table->dropColumn('remaining_payment');
            $table->dropColumn('payment_type');
            $table->dropColumn('descriptions');
            $table->dropColumn('parcel_car_ids');
            
        });
    }
};
