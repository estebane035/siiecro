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
        
        'captura_solicitud_obra',
        'captura_de_registro_basica',
        'captura_de_registro_avanzada',
        'captura_de_responsables_intervencion',
        'captura_de_catalogos_basica',
        'captura_de_catalogos_avanzada',
        'captura_de_solicitud_analisis',
        'captura_de_resultados',

        'edicion_de_registro_basica',
        'edicion_de_registro_avanzada_1',
        'edicion_de_registro_avanzada_2',
        
        'eliminar_solicitud_obra',
        'eliminar_registro',
        'eliminar_solicitud_analisis',
        'eliminar_resultados',
        'eliminar_catalogos',
        
        'acceso_a_lista_solicitudes_analisis',
        'acceso_a_lista_solicitudes_obras',
        'acceso_a_datos_basico',
        'acceso_a_datos_avanzado',
        
        'consulta_general_basica',
        'consulta_general_avanzada',
        'consulta_externa',
        'consulta_estadistica',

        'imprimir_condicionado',
        'imprimir_oficios',

        'creacion_usuarios_permisos',
        'administrar_solicitudes_obras',
        'administrar_solicitudes_analisis',
        'administrar_registro_resultados',
    ];
}
