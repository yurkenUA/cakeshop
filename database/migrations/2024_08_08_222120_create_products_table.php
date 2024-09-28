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
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->string('altname');
            $table->string('path');
            $table->string('x1600');

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->text('meta_description');
            $table->unsignedBigInteger('main_image_id')->nullable();
            $table->json('ingredients')->nullable();
            $table->boolean('is_gluten_free')->default(0);
            $table->boolean('is_customazable')->default(0);
            $table->softDeletes('deleted_at');

            $table->timestamps();
        });

        Schema::create('products_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('image_id');
            $table->integer('priority')->default(0);
        });

        Schema::create('products_sizes', function (Blueprint $table) {
            $table->id();
            
            $table->integer('size');
            
            $table->timestamps();
        });

        Schema::create('products_prices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->float('price');

            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->timestamps();
        });

        Schema::create('products_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tag_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_images');
        Schema::dropIfExists('products_sizes');
        Schema::dropIfExists('products_prices');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('products_tags');
    }
};
