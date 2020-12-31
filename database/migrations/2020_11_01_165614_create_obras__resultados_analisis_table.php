<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasResultadosAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras__resultados_analisis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitudes_analisis_muestras_id')->unsigned();
            $table->integer('forma_obtencion_muestra_id')->unsigned();
            $table->integer('tipo_material_id')->unsigned()->nullable();
            $table->integer('informacion_por_definir_id')->unsigned()->nullable();
            $table->integer('interpretacion_particular_id')->unsigned()->nullable();
            $table->integer('profesor_responsable_de_analisis_id')->unsigned();
            $table->integer('persona_realiza_analisis_id')->unsigned();

            // bitacora
            $table->integer('usuario_creo_id')->unsigned();
            $table->integer('usuario_aprobo_id')->unsigned()->nullable();
            $table->integer('usuario_rechazo_id')->unsigned()->nullable();
            $table->integer('usuario_reviso_id')->unsigned()->nullable();
            $table->text('motivo_de_rechazo')->nullable();
            
            $table->enum('estatus', config('valores.status_resultado_analisis'))->default('En revision');
            $table->datetime('fecha_aprobacion')->nullable();
            $table->datetime('fecha_rechazo')->nullable();
            $table->datetime('fecha_revision')->nullable();

            $table->date('fecha_analisis');
            $table->string('ubicacion_de_toma_muestra')->nullable();
            $table->string('descripcion')->nullable();

            $table->string('ruta_acceso_microfotografia')->comment('ruta de las fotos en sus pc')->nullable();
            $table->string('conclusion_general')->nullable();
            
            $table->timestamps();
            $table->foreign('solicitudes_analisis_muestras_id', 'solicitudes_analisis_muestras_id_foreign')->references('id')->on('obras__solicitudes_analisis_muestras');
            $table->foreign('forma_obtencion_muestra_id', 'forma_obtencion_muestra_id_foreign')->references('id')->on('obras__forma_obtencion_muestra');
            $table->foreign('tipo_material_id', 'tipo_material_id_foreign')->references('id')->on('obras__tipo_material');
            $table->foreign('informacion_por_definir_id', 'informacion_por_definir_id_foreign')->references('id')->on('obras__tipo_material__informacion_por_definir');
            $table->foreign('interpretacion_particular_id', 'interpretacion_particular_id_foreign')->references('id')->on('obras__tipo_material__interpretacion_particular');
            $table->foreign('profesor_responsable_de_analisis_id', 'profesor_responsable_de_analisis_id_foreign')->references('id')->on('users');
            $table->foreign('persona_realiza_analisis_id', 'persona_realiza_analisis_id_foreign')->references('id')->on('obras__usuarios_asignados');

            // foraneas de bitacora
            $table->foreign('usuario_creo_id')->references('id')->on('users');
            $table->foreign('usuario_aprobo_id')->references('id')->on('users');
            $table->foreign('usuario_rechazo_id')->references('id')->on('users');
            $table->foreign('usuario_reviso_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras__resultados_analisis');
    }
}
