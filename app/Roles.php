<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	protected $table = "roles";
    protected $fillable = [
    	'id',
        'nombre',
        'descripcion',
        
        'captura_de_registro_basica',
        'captura_de_registro_avanzada_1',
        'captura_de_registro_avanzada_2',
        'captura_de_solicitud',
        'captura_de_resultados_basica',
        'captura_de_resultados_avanzada',

        'edicion_de_registro_basica',
        'edicion_de_registro_avanzada_1',
        'edicion_de_registro_avanzada_2',
        'edicion_de_solicitud',
        'edicion_de_resultados_basica',
        'edicion_de_resultados_avanzada',

        'eliminar_registro',
        'eliminar_solicitud',
        'eliminar_resultados',

        'consulta_general_basica',
        'consulta_general_avanzada_1',
        'consulta_general_avanzada_2',
        'consulta_externa',
        'imprimir_condicionado',
        'imprimir',

        'admin_de_usuarios',
    ];
}
