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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('product_productcategory', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('product_id');
           $table->unsignedBigInteger('productcategory_id');
           $table->timestamps();

           $table->unique(['product_id','productcategory_id']);
           $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
           $table->foreign('productcategory_id')->references('id')->on('product_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
