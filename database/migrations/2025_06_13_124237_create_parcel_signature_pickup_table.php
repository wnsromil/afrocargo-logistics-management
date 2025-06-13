<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parcel_signature_pickup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parcel_id');
            $table->unsignedBigInteger('container_id')->nullable();
            $table->string('img')->nullable(); // path of image
            $table->text('note')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->string('status')->default(0); // 0 = pending, 1 = signed etc.
            $table->enum('delivered', ['Yes', 'No'])->default('No'); // ❌ removed 'after'
            $table->unsignedBigInteger('parcel_pickup_id')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcel_signature_pickup');
    }
};
