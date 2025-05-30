<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('broker', function (Blueprint $table) {
            $table->id();
            $table->string('name');
         $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });

        DB::table('broker')->insert([
            ['name' => 'Global Brokers', 'status' => 1],
            ['name' => 'Ocean Traders', 'status' => 1],
            ['name' => 'Prime Logistics', 'status' => 1],
            ['name' => 'Alpha Brokers', 'status' => 0],
            ['name' => 'Skyline Freight', 'status' => 1],
        ]);
    }

    public function down(): void {
        Schema::dropIfExists('broker');
    }
};
