<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasSolicitudesAnalisisMuestras extends Model
{
    protected $table = 'obras__solicitudes_analisis_muestras';
    protected $fillable = [
    	'id',
    	'solicitud_analisis_id',
    	'usuario_creo_id',
        'tipo_analisis_id',
    	'no_muestra',
    	'nomenclatura',
    	'informacion_requerida',
    	'motivo',
    	'descripcion_muestra',
    	'ubicacion'
    ];
}
