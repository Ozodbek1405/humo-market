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
        Schema::table('shop_customer', function (Blueprint $table) {
            $table->string('verify_code')->nullable();
            $table->timestamp('verify_expiration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_customer', function (Blueprint $table) {
            $table->dropColumn('verify_code');
            $table->dropColumn('verify_expiration');
        });
    }
};
