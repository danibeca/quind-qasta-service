<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentAttributeSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_attribute_series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('component_id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('impact')->unsigned();
            $table->integer('effort')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->timestamps();

            //$table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_attribute_series');
    }
}
