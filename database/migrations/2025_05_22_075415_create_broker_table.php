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
            ['name' => 'Global Brokers', 'status' => 'Active'],
            ['name' => 'Ocean Traders', 'status' => 'Active'],
            ['name' => 'Prime Logistics', 'status' => 'Active'],
            ['name' => 'Alpha Brokers', 'status' => 'Active'],
            ['name' => 'Skyline Freight', 'status' => 'Active'],
        ]);
    }

    public function down(): void {
        Schema::dropIfExists('broker');
    }
};
