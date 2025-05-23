<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Columns
            $table->unsignedBigInteger('warehouse_id')->nullable(); // Foreign key for warehouse
            $table->date('date'); // Date of the expense
            $table->string('time')->nullable();
            $table->string('img')->nullable();
            $table->text('description')->nullable(); // Description of the expense
            $table->unsignedBigInteger('creator_user_id')->nullable(); // User associated with the expense
            $table->unsignedBigInteger('container_id')->nullable(); // Container ID (if applicable)
            $table->decimal('amount', 10, 2); // Expense amount (e.g., 100.00)
            $table->string('category')->nullable(); // Expense category
            $table->unsignedBigInteger('creator_id')->nullable(); // Creator of the record
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Status with enum values

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}