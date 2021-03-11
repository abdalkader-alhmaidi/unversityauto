<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon ;

class CreateAdvertismentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->string('slice')->nullable()->default('text');
            $table->string('title')->nullable()->default('text');
            $table->string('content', 500)->nullable()->default('text');
            $table->string('photo', 100)->nullable()->default(null);
            $table->timestamp('period')->nullable()->default(Carbon::now()->addDays(7));
            //$table->time('period')->->nullable()->default(7);
          //  $table->time('period')->nullable()->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->integer('status')->unsigned()->nullable()->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         //   $table->timestamp('period')->nullable()->default(Carbon::now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisments');
    }
}
