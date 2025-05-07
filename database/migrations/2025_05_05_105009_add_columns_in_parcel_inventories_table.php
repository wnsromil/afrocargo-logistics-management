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
        Schema::table('parcel_inventories', function (Blueprint $table) {
            //
            Schema::table('parcel_inventories', function (Blueprint $table) {
                $table->string('inventory_name')->nullable()->after('inventorie_id');
                $table->unsignedBigInteger('invoice_id')->nullable()->after('inventory_name');
                $table->integer('label_qty')->nullable()->after('invoice_id');
                $table->decimal('price', 10, 2)->nullable()->after('label_qty');
                $table->decimal('value', 10, 2)->nullable()->after('price');
                $table->decimal('ins', 10, 2)->nullable()->after('value');
                $table->decimal('tax', 10, 2)->nullable()->after('ins');
                $table->decimal('total', 10, 2)->nullable()->after('tax');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcel_inventories', function (Blueprint $table) {
            //
            $table->dropColumn([
                'inventory_name',
                'invoice_id',
                'label_qty',
                'price',
                'ins',
                'tax',
                'total',
                'value'
            ]);
        });
    }
};
