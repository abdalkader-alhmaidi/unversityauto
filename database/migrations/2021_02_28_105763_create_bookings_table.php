<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('matrial_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->integer('lecture')->unsigned()->nullable();
            $table->string('day', 100)->default('sunday');
            
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('matrial_id')->references('id')->on('matrials');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
         
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
