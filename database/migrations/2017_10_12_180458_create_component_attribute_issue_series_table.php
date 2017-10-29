<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentAttributeIssueSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_attribute_issue_series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->integer('impact');
            $table->integer('effort');
            $table->integer('quantity');
            $table->integer('component_id')->unsigned();;
            $table->timestamps();

            $table->index(['component_id','attribute_id']);
            $table->foreign('component_id', 'fk_attribute_component')->references('id')->on('components')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_attribute_issue_series');
    }
}
