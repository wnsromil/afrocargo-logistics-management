<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('notifications');
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique(); // TNT-00001 etc.
            $table->string('title');
            $table->string('message');
            $table->string('notification_for'); // All, Drivers, Warehouse, etc.
            $table->timestamp('notification_datetime');
            $table->enum('status', ['Inactive', 'Active'])->default('Active')->nullable();
            $table->string('type')->nullable(); // Custom type: info, alert, etc.
            $table->unsignedBigInteger('user_id')->nullable(); // Can be null
            // Image field - optional
            $table->string('img')->nullable(); // Path or filename of the image

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
