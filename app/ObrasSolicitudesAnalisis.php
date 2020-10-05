<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasSolicitudesAnalisis extends Model
{
    protected $table = 'obras__solicitudes_analisis';
    protected $fillable = [
    	'id',
    	'obra_id',
        'creo_usuario_id',
    	'obra_usuario_asignado_id',
    	'tecnica',
    	'fecha_intervencion',
    	'esquema',
    ];
}
