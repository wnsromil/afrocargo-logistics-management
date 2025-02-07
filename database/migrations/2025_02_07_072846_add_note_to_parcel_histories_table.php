<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('parcel_histories', function (Blueprint $table) {
            $table->text('note')->nullable()->after('description');
        });
    }

    public function down() {
        Schema::table('parcel_histories', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
};
