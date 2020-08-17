<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userProfile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usersId')->nullable(); 
            $table->string('firstName');
            $table->string('lastName');
            $table->string('telephone');
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->text('address');
            $table->string('avatar')->nullable();
            $table->timestamps();

            $table->foreign('usersId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userProfile');
    }
}
