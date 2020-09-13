<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->increments('id');

            // Datos generales de identificacion
            $table->integer('tipo_objeto_id')->unsigned();
            $table->integer('tipo_bien_cultural_id')->unsigned();
            $table->integer('epoca_id')->unsigned()->nullable();
            $table->integer('temporalidad_id')->unsigned();
            $table->string('nombre')->index();
            $table->string('autor')->index();
            $table->string('cultura')->index();
            $table->string('lugar_procedencia_actual');
            $table->string('numero_inventario');
            $table->date('año')->nullable();
            $table->enum('estatus_año', config('valores.status_años_obras'))->nullable();
            $table->enum('estatus_epoca', config('valores.status_años_obras'))->nullable();

            $table->timestamps();

            $table->foreign('tipo_objeto_id')->references('id')->on('obras__tipo_objeto');
            $table->foreign('tipo_bien_cultural_id')->references('id')->on('obras__tipo_bien_cultural');
            $table->foreign('epoca_id')->references('id')->on('obras__epoca');
            $table->foreign('temporalidad_id')->references('id')->on('obras__temporalidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras');
    }
}
