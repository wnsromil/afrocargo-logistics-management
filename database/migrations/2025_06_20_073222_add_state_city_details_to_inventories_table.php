<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('color')->nullable();
            $table->string('open')->nullable();
            $table->string('capacity')->nullable();
            $table->string('un_rating')->nullable();
            $table->string('model_number')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn([
                'state',
                'city',
                'color',
                'open',
                'capacity',
                'un_rating',
                'model_number',
            ]);
        });
    }
};
