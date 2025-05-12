<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Update ENUM for 'role' column
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','warehouse_manager','customer','driver','ship_to_customer')");

        // Add 'parent_customer_id' field
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_customer_id')->nullable()->after('role');

            // Optional: Add foreign key constraint to self
            $table->foreign('parent_customer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Rollback enum change (revert back without 'ship_to_customer')
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'customer')");

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['parent_customer_id']);
            $table->dropColumn('parent_customer_id');
        });
    }
};
