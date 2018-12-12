<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexes', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date_in');
            $table->double('quantity', 15, 4);
            $table->date('date_out')->nullable();
            $table->double('index', 4, 2)->nullable();
            $table->integer('material_id')->unsigned();
            $table->enum('process', ['anodizado', 'pintura']);

            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indexes');
    }
}
