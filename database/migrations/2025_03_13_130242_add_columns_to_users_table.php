<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('apartment')->nullable();
            $table->string('username')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('website_url')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->date('signature_date')->nullable();
            $table->integer('year_to_date')->nullable();
            $table->string('language')->nullable();
            $table->boolean('write_comment')->default(false);
            $table->boolean('read_comment')->default(false);
            $table->string('signature_img')->nullable();
            $table->string('contract_signature_img')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company_name', 'apartment', 'username', 'latitude', 'longitude', 'website_url', 
                'warehouse_id', 'signature_date', 'year_to_date', 'language', 'write_comment', 
                'read_comment', 'signature_img', 'contract_signature_img'
            ]);
        });
    }
};
