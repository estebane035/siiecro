<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->tinyInteger('captura_solicitud_obra')                   ->unsigned()->default(0);
            $table->tinyInteger('captura_de_registro_basica')               ->unsigned()->default(0);
            $table->tinyInteger('captura_de_registro_avanzada')             ->unsigned()->default(0);
            $table->tinyInteger('captura_de_responsables_intervencion')     ->unsigned()->default(0);
            $table->tinyInteger('captura_de_catalogos_basica')              ->unsigned()->default(0);
            $table->tinyInteger('captura_de_catalogos_avanzada')            ->unsigned()->default(0);
            $table->tinyInteger('captura_de_solicitud_analisis')            ->unsigned()->default(0);
            $table->tinyInteger('captura_de_resultados')                    ->unsigned()->default(0);
            
            $table->tinyInteger('edicion_de_registro_basica')               ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_registro_avanzada_1')           ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_registro_avanzada_2')           ->unsigned()->default(0);
            
            $table->tinyInteger('eliminar_solicitud_obra')                  ->unsigned()->default(0);
            $table->tinyInteger('eliminar_registro')                        ->unsigned()->default(0);
            $table->tinyInteger('eliminar_solicitud_analisis')              ->unsigned()->default(0);
            $table->tinyInteger('eliminar_resultados')                      ->unsigned()->default(0);
            $table->tinyInteger('eliminar_catalogos')                       ->unsigned()->default(0);
            
            $table->tinyInteger('acceso_a_lista_solicitudes_analisis')      ->unsigned()->default(0);
            $table->tinyInteger('acceso_a_lista_solicitudes_obras')         ->unsigned()->default(0);
            $table->tinyInteger('acceso_a_datos_basico')                    ->unsigned()->default(0);
            $table->tinyInteger('acceso_a_datos_avanzado')                  ->unsigned()->default(0);
            
            $table->tinyInteger('consulta_general_basica')                  ->unsigned()->default(0);
            $table->tinyInteger('consulta_general_avanzada')                ->unsigned()->default(0);
            $table->tinyInteger('consulta_externa')                         ->unsigned()->default(0);
            $table->tinyInteger('consulta_estadistica')                     ->unsigned()->default(0);
            
            $table->tinyInteger('imprimir_condicionado')                    ->unsigned()->default(0);
            $table->tinyInteger('imprimir_oficios')                         ->unsigned()->default(0);
            
            $table->tinyInteger('creacion_usuarios_permisos')               ->unsigned()->default(0);
            $table->tinyInteger('administrar_solicitudes_obras')            ->unsigned()->default(0);
            $table->tinyInteger('administrar_solicitudes_analisis')         ->unsigned()->default(0);
            $table->tinyInteger('administrar_registro_resultados')          ->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
