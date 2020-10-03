<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasSolicitudesAnalisisMuestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__solicitudes_analisis_muestras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_analisis_id')->unsigned();
            $table->integer('usuario_creo_id')->unsigned();
            $table->integer('tipo_analisis_id')->unsigned();
            // $table->integer('usuario_responsable_id')->unsigned()->nullable();
            
            $table->string('no_muestra');
            $table->string('nomenclatura');
            $table->string('informacion_requerida');
            $table->string('motivo');
            $table->string('descripcion_muestra');
            $table->string('ubicacion');
            $table->timestamps();

            $table->foreign('solicitud_analisis_id', 'solicitud_id_foreign')->references('id')->on('obras__solicitudes_analisis');
            $table->foreign('usuario_creo_id')->references('id')->on('users');    
            $table->foreign('tipo_analisis_id', 'obras__solicitudes_tipo_analisis_id_foreign')->references('id')->on('obras__solicitudes_analisis_tipo_analisis');    
            // $table->foreign('usuario_responsable_id')->references('id')->on('users');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__detalle_solicitudes_analisis_muestras');
    }
}
