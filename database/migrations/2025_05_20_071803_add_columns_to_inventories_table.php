<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->string('inventary_sub_type')->nullable();
            $table->enum('barcode_have', ['Yes', 'No'])->default('No');
            $table->string('package_type')->nullable();
            $table->decimal('retail_shipping_price', 10, 2)->nullable();
            $table->enum('driver_app_access', ['Yes', 'No'])->default('No');
            $table->string('country')->nullable();
            $table->string('state_zone')->nullable();
            $table->decimal('item_length_inch', 10, 2)->nullable();
            $table->decimal('weight_price', 10, 2)->nullable();
            $table->decimal('volume_total', 10, 2)->nullable();
            $table->decimal('volume_price', 10, 2)->nullable();
            $table->decimal('factor', 10, 2)->nullable();
            $table->enum('insurance_have', ['Yes', 'No'])->default('No');
            $table->string('insurance')->nullable();
            $table->integer('qty_on_hand')->nullable();
            $table->decimal('retail_vaule_price', 10, 2)->nullable();
            $table->decimal('value_price', 10, 2)->nullable();
            $table->decimal('last_cost_received', 10, 2)->nullable();
            $table->integer('re_order_point')->nullable();
            $table->integer('re_order_quantity')->nullable();
            $table->date('last_date_received')->nullable();
            $table->decimal('tax_percentage', 5, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn([
                'inventary_sub_type',
                'barcode_have',
                'package_type',
                'retail_shipping_price',
                'driver_app_access',
                'country',
                'state_zone',
                'item_length_inch',
                'weight_price',
                'volume_total',
                'volume_price',
                'factor',
                'insurance_have',
                'insurance',
                'qty_on_hand',
                'retail_vaule_price',
                'value_price',
                'last_cost_received',
                're_order_point',
                're_order_quantity',
                'last_date_received',
                'tax_percentage',
            ]);
        });
    }
}
