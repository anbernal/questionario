<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrizs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topics_id')->unsigned();
            $table->foreign('topics_id')->references('id')->on('topics');
            $table->integer('funcaos_id')->unsigned();
            $table->foreign('funcaos_id')->references('id')->on('funcaos');
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
        Schema::dropIfExists('matriz');
    }
}
