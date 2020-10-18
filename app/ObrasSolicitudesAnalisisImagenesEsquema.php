<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasSolicitudesAnalisisImagenesEsquema extends Model
{
    protected $table = 'obras__solicitudes_analisis_imagenes_esquema';
    protected $fillable = [
    	'id',
    	'solicitud_analisis_id',
        'imagen',
    ];

    public function solicitud_analisis() {
        return $this->hasOne('App\ObrasSolicitudesAnalisis', 'id', 'solicitud_analisis_id');
    }
}
