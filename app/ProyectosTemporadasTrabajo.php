<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class ProyectosTemporadasTrabajo extends Model
{
    protected $table = "proyectos__temporadas_trabajo";
    protected $fillable = [
    	'id',
        'proyecto_id',
        'año',
        'numero_temporada'
    ];

    public function proyecto() {
        return $this->hasOne('App\Proyectos', 'id', 'proyecto_id');
    }
}
