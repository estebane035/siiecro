<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterialInterpretacionParticular extends Model
{
    protected $table = 'obras__tipo_material__interpretacion_particular';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
