<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasResultadosAnalisisEsquemaMuestraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__resultados_analisis_esquema_muestra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resultado_analisis_id')->unsigned();
            $table->string('imagen');
            $table->timestamps();
            $table->foreign('resultado_analisis_id', 'resultado_analisis_esquema_muestra_id_foreign')->references('id')->on('obras__resultados_analisis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__resultados_analisis_esquema_muestra');
    }
}
