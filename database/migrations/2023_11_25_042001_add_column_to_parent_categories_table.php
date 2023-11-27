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
        Schema::table('parent_categories', function (Blueprint $table) {
            $table->bigInteger('min')->nullable();
            $table->bigInteger('max')->nullable();
            $table->boolean('dress_size')->nullable();
            $table->boolean('shoe_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parent_categories', function (Blueprint $table) {
            $table->dropColumn('min');
            $table->dropColumn('max');
            $table->dropColumn('dress_size');
            $table->dropColumn('shoe_size');
        });
    }
};
