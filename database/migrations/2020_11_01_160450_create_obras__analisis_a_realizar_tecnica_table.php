<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasAnalisisARealizarTecnicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__analisis_a_realizar_tecnica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('analisis_a_realizar_id')->unsigned()->nullable();
            $table->string('nombre');

            $table->timestamps();
            $table->foreign('analisis_a_realizar_id', 'analisis_a_realizar_id_foreign')->references('id')->on('obras__analisis_a_realizar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__analisis_a_realizar_tecnica');
    }
}
