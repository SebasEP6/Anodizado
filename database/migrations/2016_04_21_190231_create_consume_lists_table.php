<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consume_lists', function (Blueprint $table) {
            $table->increments('id');

            $table->double('quantity', 15, 4);
            $table->integer('material_id')->unsigned();
            $table->integer('consume_id')->unsigned();

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('consume_id')->references('id')->on('consume');

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
        Schema::drop('consume_lists');
    }
}
