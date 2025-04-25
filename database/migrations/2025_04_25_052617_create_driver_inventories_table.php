<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverInventoriesTable extends Migration
{
    public function up()
    {
        Schema::create('driver_inventories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('time')->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->enum('in_out', ['In', 'Out']);
            $table->unsignedBigInteger('items_id');
            $table->integer('quantity');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->unsignedBigInteger('creator_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_inventories');
    }
}
