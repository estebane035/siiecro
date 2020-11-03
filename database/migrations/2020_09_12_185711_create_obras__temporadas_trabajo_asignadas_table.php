<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTemporadasTrabajoAsignadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__temporadas_trabajo_asignadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obra_id')->unsigned();
            $table->integer('proyecto_temporada_trabajo_id')->unsigned();
            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras');
            $table->foreign('proyecto_temporada_trabajo_id', 'obra_proyecto_temporada_trabajo_id_foreign')->references('id')->on('proyectos__temporadas_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__temporadas_trabajo_asignadas');
    }
}
