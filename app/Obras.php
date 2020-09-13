<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    protected $fillable = [
        'epoca_id',
        'temporalidad_id',
        'nombre',
        'autor',
        'cultura',
        'lugar_procedencia_actual',
        'numero_inventario',
        'año',
        'estatus_año',
        'estatus_epoca',
    ];

    public function getFolioAttribute(){
    	return $this->id;
    }
}
