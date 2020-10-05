<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasSolicitudesAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__solicitudes_analisis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obra_id')->unsigned();
            // campo creo_usuario_id para un tipo de bitacora de quien creó la solicitud de análisis
            $table->integer('creo_usuario_id')->unsigned();
            $table->integer('obra_usuario_asignado_id')->unsigned();

            // tengo dudas sobre si va aquí técnica
            $table->string('tecnica');
            $table->date('fecha_intervencion');
            $table->text('esquema');
            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras');
            $table->foreign('creo_usuario_id')->references('id')->on('users');
            $table->foreign('obra_usuario_asignado_id')->references('usuario_id')->on('obras__usuarios_asignados');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__detalle_solicitudes_analisis');
    }
}
