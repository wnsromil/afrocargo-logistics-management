<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortWiseFreightsTable extends Migration
{
    public function up()
    {
        Schema::create('port_wise_freights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_user_id');
            $table->string('from_country');
            $table->string('from_port');
            $table->string('to_country');
            $table->string('to_port');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->enum('is_deleted', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('port_wise_freights');
    }
}
