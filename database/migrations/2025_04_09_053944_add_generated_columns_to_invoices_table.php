<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeneratedColumnsToInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->enum('generated_by', ['admin', 'warehouse_manager', 'driver', 'self'])->nullable()->default('admin')->after('id');
            $table->enum('generated_status', ['view_only', 'generated'])->nullable() ->default('generated')->after('generated_by');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('generated_by');
            $table->dropColumn('generated_status');
        });
    }
}
