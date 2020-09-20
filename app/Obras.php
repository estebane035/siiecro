<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    protected $fillable = [
        'epoca_id',
        'temporalidad_id',
        'tipo_objeto_id',
        'tipo_bien_cultural_id',
        'nombre',
        'autor',
        'cultura',
        'alto',
        'largo',
        'ancho',
        'lugar_procedencia_actual',
        'numero_inventario',
        'año',
        'estatus_año',
        'estatus_epoca',
        'fecha_aprobacion',
        'fecha_rechazo'
    ];

    public function getFolioAttribute(){
    	return $this->id."-20/INT-STRPM";
    }
}
