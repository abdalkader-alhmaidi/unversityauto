<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->default('text');
         //   $table->string('catId');
            $table->integer('term')->default(1);
           
            
            $table->timestamps();

           // $table->foreign('catId')->references('catId')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matrial');
    }
}
