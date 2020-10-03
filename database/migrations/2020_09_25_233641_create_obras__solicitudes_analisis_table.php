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
            $table->integer('usuario_id')->unsigned();

            // tengo dudas sobre si va aquí técnica
            $table->string('tecnica');
            $table->date('fecha_intervencion');
            $table->string('responsable');
            $table->text('esquema');
            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras');
            $table->foreign('usuario_id')->references('id')->on('users');            
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
