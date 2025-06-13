<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('container_company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
              $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });

        DB::table('container_company')->insert([
            ['name' => 'MCA', 'status' => 'Active'],
            ['name' => 'Maersk', 'status' => 'Active'],
            ['name' => 'CMA CGM', 'status' => 'Active'],
            ['name' => 'Evergreen', 'status' => 'Active'],
            ['name' => 'Hapag-Lloyd', 'status' => 'Active'],
        ]);
    }

    public function down(): void {
        Schema::dropIfExists('container_company');
    }
};
