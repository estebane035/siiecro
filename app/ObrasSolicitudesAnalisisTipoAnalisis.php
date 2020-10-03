<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasSolicitudesAnalisisTipoAnalisis extends Model
{
    protected $table = 'obras__solicitudes_analisis_tipo_analisis';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
