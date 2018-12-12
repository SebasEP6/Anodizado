<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartialListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partial_lists', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('partial_id')->unsigned();
            $table->bigInteger('production_list_id')->unsigned();
            $table->bigInteger('aluminum_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->integer('total');
            $table->integer('quantity');
            $table->bigInteger('client_id')->unsigned();

            $table->foreign('partial_id')->references('id')->on('partials');
            $table->foreign('production_list_id')->references('id')->on('production_lists');
            $table->foreign('aluminum_id')->references('id')->on('aluminum');
            $table->foreign('color_id')->references('id')->on('colors');
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
        Schema::drop('partial_lists');
    }
}
