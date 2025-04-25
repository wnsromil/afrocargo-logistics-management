<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIdToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add unique_id column to the 'expenses' table
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('unique_id')->nullable()->after('id'); // Add after the 'id' column
        });

        // Add unique_id column to the 'inventories' table
        Schema::table('inventories', function (Blueprint $table) {
            $table->string('unique_id')->nullable()->after('id'); // Add after the 'id' column
        });

        // Add unique_id column to the 'parcels' table
        Schema::table('parcels', function (Blueprint $table) {
            $table->string('unique_id')->nullable()->after('id'); // Add after the 'id' column
        });

        // Add unique_id column to the 'vehicles' table
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('unique_id')->nullable()->after('id'); // Add after the 'id' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop unique_id column from the 'expenses' table
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('unique_id');
        });

        // Drop unique_id column from the 'inventories' table
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('unique_id');
        });

        // Drop unique_id column from the 'parcels' table
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('unique_id');
        });

        // Drop unique_id column from the 'vehicles' table
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('unique_id');
        });
    }
}
