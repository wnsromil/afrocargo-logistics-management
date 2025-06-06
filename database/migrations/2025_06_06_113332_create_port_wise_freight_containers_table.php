<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortWiseFreightContainersTable extends Migration
{
    public function up()
    {
        Schema::create('port_wise_freight_containers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('port_freight_id');
            $table->unsignedBigInteger('container_size_id');
            $table->decimal('freight_price', 10, 2);
            $table->string('currency', 10);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->enum('is_delete', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('port_wise_freight_containers');
    }
}
