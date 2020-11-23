<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasAnalisisARealizarMicrofotografiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__analisis_a_realizar_microfotografia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('analisis_a_realizar_resultado_id')->unsigned();
            $table->string('imagen');
            $table->timestamps();
            $table->foreign('analisis_a_realizar_resultado_id', 'analisis_a_realizar_resultado_id_foreign')->references('id')->on('obras__analisis_a_realizar_resultados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__analisis_a_realizar_microfotografia');
    }
}
