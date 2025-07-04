<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('parcel_inventories', function (Blueprint $table) {
            //
            $table->decimal('discount', 8, 2)->default(0)->after('tax')->comment('Discount on the inventory item');
        });

        \DB::statement("ALTER TABLE parcel_inventories CHANGE inventorie_id inventorie_id BIGINT(20) UNSIGNED NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcel_inventories', function (Blueprint $table) {
            //
            $table->dropColumn('discount');
        });
    }
};
