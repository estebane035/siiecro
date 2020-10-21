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
            $table->integer('usuario_aprobo_id')->unsigned()->nullable();
            $table->integer('usuario_rechazo_id')->unsigned()->nullable();
            $table->integer('usuario_reviso_id')->unsigned()->nullable();
            $table->integer('obra_usuario_asignado_id')->unsigned();

            $table->text('motivo_de_rechazo')->nullable();
            $table->string('tecnica');
            $table->date('fecha_intervencion');
            $table->enum('estatus', config('valores.status_solicitud_analisis'))->default('En revision');
            $table->datetime('fecha_aprobacion')->nullable();
            $table->datetime('fecha_rechazo')->nullable();
            $table->datetime('fecha_revision')->nullable();
            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras');
            $table->foreign('creo_usuario_id')->references('id')->on('users');
            $table->foreign('usuario_aprobo_id')->references('id')->on('users');
            $table->foreign('usuario_rechazo_id')->references('id')->on('users');
            $table->foreign('usuario_reviso_id')->references('id')->on('users');
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
