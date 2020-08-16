<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName')->require();
            $table->string('productsDescription')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('gallery')->nullable();
            $table->unsignedBigInteger('brandsId')->nullable(); 
            $table->unsignedBigInteger('categoriesId')->nullable();
            $table->decimal('price',12,4);
            $table->unsignedInteger('quantity')->default(1);
            $table->tinyInteger('isActive')->default(1);
            $table->timestamps();

            $table->foreign('brandsId')->references('id')->on('brands');
            $table->foreign('categoriesId')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
