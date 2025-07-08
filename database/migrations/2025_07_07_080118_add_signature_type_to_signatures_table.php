<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->string('signature_type')->default('image')->after('signature_file')
                ->comment('Signature type: image or draw');
        });
    }

    public function down()
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->dropColumn('signature_type');
        });
    }
};
