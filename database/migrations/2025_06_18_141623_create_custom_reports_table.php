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
        Schema::create('custom_reports', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->nullable();
            $table->string('doc_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->decimal('invoiced',10,2)->default(0);
            $table->decimal('expense',10,2)->default(0);
            $table->decimal('expense_income',10,2)->default(0);
            $table->dateTime('report_date')->nullable();
            $table->string('report_type')->default('Invoice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_reports');
    }
};
