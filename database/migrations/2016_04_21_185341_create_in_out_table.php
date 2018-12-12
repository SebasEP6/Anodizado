<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_out', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('type', ['input', 'output']);
            $table->enum('process', ['anodizado', 'pintura']);

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
        Schema::drop('in_out');
    }
}
