<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('license_number')->nullable()->after('phone'); // License Number
            $table->date('license_expiry_date')->nullable()->after('license_number'); // License Expiry Date
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['license_number', 'license_expiry_date']);
        });
    }
};
