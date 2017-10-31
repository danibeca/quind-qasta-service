<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ci_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->timestamps();
        });

        DB::table('ci_indicators')->insert(
            array(
                array(
                    'id' => 1,
                    'name' => 'Automatizacion'
                )
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ci_indicators');
    }
}
