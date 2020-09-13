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
            $table->tinyInteger('captura_de_registro_basica')       ->unsigned()->default(0);
            $table->tinyInteger('captura_de_registro_avanzada_1')   ->unsigned()->default(0);
            $table->tinyInteger('captura_de_registro_avanzada_2')   ->unsigned()->default(0);
            $table->tinyInteger('captura_de_solicitud')             ->unsigned()->default(0);
            $table->tinyInteger('captura_de_resultados_basica')     ->unsigned()->default(0);
            $table->tinyInteger('captura_de_resultados_avanzada')   ->unsigned()->default(0);
            
            $table->tinyInteger('edicion_de_registro_basica')       ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_registro_avanzada_1')   ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_registro_avanzada_2')   ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_solicitud')             ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_resultados_basica')     ->unsigned()->default(0);
            $table->tinyInteger('edicion_de_resultados_avanzada')   ->unsigned()->default(0);
            
            $table->tinyInteger('eliminar_registro')                ->unsigned()->default(0);
            $table->tinyInteger('eliminar_solicitud')               ->unsigned()->default(0);
            $table->tinyInteger('eliminar_resultados')              ->unsigned()->default(0);
            
            $table->tinyInteger('consulta_general_basica')          ->unsigned()->default(0);
            $table->tinyInteger('consulta_general_avanzada_1')      ->unsigned()->default(0);
            $table->tinyInteger('consulta_general_avanzada_2')      ->unsigned()->default(0);
            $table->tinyInteger('consulta_externa')                 ->unsigned()->default(0);
            $table->tinyInteger('imprimir_condicionado')            ->unsigned()->default(0);
            $table->tinyInteger('imprimir')                         ->unsigned()->default(0);
            $table->tinyInteger('admin_de_usuarios')                ->unsigned()->default(0);
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
