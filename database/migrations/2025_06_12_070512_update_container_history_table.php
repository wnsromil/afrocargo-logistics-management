<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('container_history', function (Blueprint $table) {           
            // ✅ 2. Modify existing columns
            $table->date('transfer_date')->nullable()->change();
            $table->integer('no_of_orders')->default(0)->change();
            $table->unsignedBigInteger('driver_id')->nullable()->change();
        });

        // ✅ 3. Modify 'type' enum to add 'Active'
        DB::statement("ALTER TABLE container_history MODIFY COLUMN type ENUM('Transfer', 'Arrived', 'Active','Inactive')");
    }

    public function down(): void
    {
        // Rollback changes
        Schema::table('container_history', function (Blueprint $table) {
            $table->date('transfer_date')->nullable(false)->change();
            $table->integer('no_of_orders')->default(null)->change();
            $table->unsignedBigInteger('driver_id')->nullable(false)->change();
        });

        // Rollback enum value change
        DB::statement("ALTER TABLE container_history MODIFY COLUMN type ENUM('Transfer', 'Arrived')");
    }
};
