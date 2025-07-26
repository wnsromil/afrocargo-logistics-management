<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationParcelTable extends Migration
{
    public function up()
    {
        Schema::create('notification_parcel', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parcel_id')->nullable();
            $table->unsignedBigInteger('notification_parcel_message_id')->nullable();
            $table->string('type');
            $table->timestamps();

            // Foreign keys (optional)
        
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_parcel');
    }
}
