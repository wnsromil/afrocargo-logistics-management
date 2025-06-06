<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_pickup_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_customer_id');
            $table->unsignedBigInteger('pickup_address_id');
            $table->unsignedBigInteger('shipto_address_id');
            $table->string('Item1')->nullable();
            $table->string('Item2')->nullable();
            $table->string('pickup_delivery')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // FIXED
            $table->date('Date')->nullable();
            $table->time('Time')->nullable();
            $table->date('Done_Date')->nullable();
            $table->string('Zone')->nullable();
            $table->unsignedBigInteger('Driver_id')->nullable();
            $table->text('Note')->nullable();
            $table->integer('Box_quantity')->default(0);
            $table->integer('Barrel_quantity')->default(0);
            $table->integer('Tapes_quantity')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pickup_details');
    }
};
