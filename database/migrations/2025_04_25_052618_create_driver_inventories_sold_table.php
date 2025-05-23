<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverInventoriesSoldTable extends Migration
{
    public function up()
    {
        Schema::create('driver_inventories_soldes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_inventories_id');
            $table->unsignedBigInteger('driver_id');
            $table->date('date');
            $table->unsignedBigInteger('customer_id');
            $table->string('invoice_no');
            $table->string('type');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_inventories_sold');
    }
}

