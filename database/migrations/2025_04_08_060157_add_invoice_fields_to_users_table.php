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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('invoice_custmore_type', ['from_to', 'ship_to'])->default('from_to')->after('contract_signature_img'); // ya jis field ke baad chahiye
            $table->unsignedBigInteger('invoice_custmore_id')->nullable()->after('invoice_custmore_type');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['invoice_custmore_type', 'invoice_custmore_id']);
        });
    }
    
};
