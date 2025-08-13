<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckingCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('trucking_company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trucking_company');
    }
}
