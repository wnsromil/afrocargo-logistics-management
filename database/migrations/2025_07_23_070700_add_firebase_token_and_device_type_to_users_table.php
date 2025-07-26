<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notification_parcel_message', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('message'); // will include placeholders like {driver_name}
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('type')->nullable(); // like "assign", "delivered", etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_parcel_message');
    }
};
