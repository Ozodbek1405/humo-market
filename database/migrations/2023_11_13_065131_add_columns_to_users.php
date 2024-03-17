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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('verify_code')->nullable();
            $table->timestamp('verify_expiration')->nullable();
            $table->string('google_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('verify_code');
            $table->dropColumn('verify_expiration');
            $table->dropColumn('google_id');
            $table->dropColumn('company_id');
            $table->dropColumn('user_id');
        });
    }
};
