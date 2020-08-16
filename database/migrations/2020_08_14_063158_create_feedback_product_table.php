<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbackProducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usersId');
            $table->string('name');
            $table->unsignedBigInteger('productsId');
            $table->tinyInteger('point')->default(10)->max(10);
            $table->string('feel');
            $table->string('image');
            $table->timestamps();

            $table->foreign('usersId')->references('id')->on('users');
            $table->foreign('productsId')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbackProducts');
    }
}
