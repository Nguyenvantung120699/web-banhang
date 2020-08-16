<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId');
            $table->string('customerName');
            $table->string('shippingAddress');
            $table->string('telephone');
            $table->decimal('grandTotal',12,4);
            $table->string('paymentMethod');
            $table->string('customerNote');
            $table->unsignedInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
        });
        Schema::create('productsOrder',function (Blueprint $table){
            $table->unsignedBigInteger('orderId');
            $table->unsignedBigInteger('productId');
            $table->unsignedInteger('quantity');
            $table->decimal('price',12,4);
            $table->decimal('total',12,4);

            $table->foreign('orderId')->references('id')->on('orders');
            $table->foreign('productId')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
