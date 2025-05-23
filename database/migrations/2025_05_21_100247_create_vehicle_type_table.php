<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });

        // Insert default data
        DB::table('vehicle_types')->insert([
            ['name' => 'Container', 'status' => 'Active'],
            ['name' => '2 Wheeler', 'status' => 'Active'],
            ['name' => 'Van', 'status' => 'Active'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};