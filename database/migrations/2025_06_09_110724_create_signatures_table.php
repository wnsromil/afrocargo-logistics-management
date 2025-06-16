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
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id');
            $table->string('signature_name');
            $table->string('signature_file'); // path to uploaded file
            $table->unsignedBigInteger('creator_user_id'); // new field
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->enum('is_deleted', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
