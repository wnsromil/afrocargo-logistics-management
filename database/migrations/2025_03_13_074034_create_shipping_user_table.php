<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('shipping_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_user_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('created_id');
            $table->string('country_id');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('ship_to_id')->default('Done');
            $table->string('company_name');
            $table->string('apartment')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('lookup_name');
            $table->string('province');
            $table->string('municipal');
            $table->string('sector');
            $table->string('language');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_user');
    }
};
