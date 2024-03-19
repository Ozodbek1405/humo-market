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
            $table->string('name_uz');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('title_uz')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('desc_uz')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('desc_ru')->nullable();
            $table->longText('images')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('parent_category_id')->nullable();
            $table->integer('child_category_id')->nullable();
            $table->integer('views')->nullable();
            $table->integer('count');
            $table->integer('rate')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('volume')->nullable();
            $table->string('weight')->nullable();
            $table->string('materials')->nullable();
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
