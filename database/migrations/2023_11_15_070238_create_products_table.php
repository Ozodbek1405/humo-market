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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->longText('images')->nullable();
            $table->string('product_colors_id');
            $table->string('product_sizes_id');
            $table->integer('brand_id')->nullable();
            $table->integer('parent_category_id')->nullable();
            $table->integer('child_category_id')->nullable();
            $table->integer('views')->nullable();
            $table->integer('count');
            $table->integer('rate')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
