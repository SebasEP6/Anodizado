<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_lists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('in_out_lists_id')->unsigned();
            $table->bigInteger('production_id')->unsigned();
            $table->bigInteger('aluminum_id')->unsigned();
            $table->integer('colorI_id')->unsigned();
            $table->integer('colorO_id')->unsigned();
            $table->integer('total');
            $table->integer('quantity');
            $table->bigInteger('client_id')->unsigned();
            $table->integer('group');

            $table->foreign('in_out_lists_id')->references('id')->on('in_out_lists');
            $table->foreign('production_id')->references('id')->on('production');
            $table->foreign('aluminum_id')->references('id')->on('aluminum');
            $table->foreign('colorI_id')->references('id')->on('colors');
            $table->foreign('colorO_id')->references('id')->on('colors');
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
        Schema::drop('production_lists');
    }
}
