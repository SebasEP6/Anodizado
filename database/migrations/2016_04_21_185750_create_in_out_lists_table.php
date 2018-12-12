<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInOutListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_out_lists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('total');
            $table->integer('quantity');
            $table->bigInteger('aluminum_id')->unsigned();
            $table->integer('colorI_id')->unsigned()->nullable();
            $table->integer('colorO_id')->unsigned();
            $table->bigInteger('in_out_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();

            $table->foreign('aluminum_id')->references('id')->on('aluminum');
            $table->foreign('colorI_id')->references('id')->on('colors');
            $table->foreign('colorO_id')->references('id')->on('colors');
            $table->foreign('in_out_id')->references('id')->on('in_out');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('in_out_lists');
    }
}
