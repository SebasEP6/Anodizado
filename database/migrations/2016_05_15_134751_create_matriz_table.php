<?php

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
        Schema::create('matriz', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('material_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->tinyInteger('value');

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matriz');
    }
}
