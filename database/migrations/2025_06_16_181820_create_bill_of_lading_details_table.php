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
        Schema::create('bill_of_lading_details', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->nullable();
            $table->unsignedBigInteger('shipperDetails_id')->nullable();
            $table->unsignedBigInteger('consigneeDetails_id')->nullable();
            $table->string('email')->nullable();
            $table->text('notify_party')->nullable();
            $table->text('pier')->nullable();
            $table->string('vessel')->nullable();
            $table->string('port_of_dischard')->nullable();
            $table->string('port_of_loading')->nullable();
            $table->string('place_of_delivery')->nullable();
            $table->string('document_no')->nullable();
            $table->text('expert_referent')->nullable();
            $table->string('forwarding_agent_reference')->nullable();
            $table->text('point_and_country_of_origin')->nullable();
            $table->text('domestic_routing_export_instruction')->nullable();
            $table->text('delivery_agent')->nullable();
            $table->string('mark_and_no')->nullable();
            $table->text('no_of_packages')->nullable();
            $table->text('desc_of_packages')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('measurement')->nullable();
            $table->text('delivery_list')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_of_lading_details');
    }
};
