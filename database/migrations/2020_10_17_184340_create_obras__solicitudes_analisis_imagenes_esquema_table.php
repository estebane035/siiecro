<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasSolicitudesAnalisisImagenesEsquemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__solicitudes_analisis_imagenes_esquema', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_analisis_id')->unsigned();
            $table->string('imagen');
            $table->timestamps();
            $table->foreign('solicitud_analisis_id', 'imagen_esquema_solicitud_id_foreign')->references('id')->on('obras__solicitudes_analisis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__solicitudes_analisis_imagenes_esquema');
    }
}
