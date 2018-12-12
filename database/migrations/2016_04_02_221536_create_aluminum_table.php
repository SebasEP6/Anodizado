<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAluminumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluminum', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('code')->unique();
            $table->string('name');
            $table->double('area', 15, 4);
            $table->double('weight', 15, 4);
            $table->bigInteger('quantity');
            $table->integer('group_id')->unsigned();
            $table->integer('pGroup');
            $table->integer('aGroup');

            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aluminum');
    }
}
