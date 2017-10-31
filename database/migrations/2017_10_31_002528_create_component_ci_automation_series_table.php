<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentCiAutomationSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_ci_automation_series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('process_phase_id')->unsigned()->nullable();
            $table->integer('component_id')->unsigned();
            $table->double('value');
            $table->timestamps();

            $table->foreign('component_id', 'fk_automation_component')->references('id')->on('components')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_ci_automation_series');
    }
}
