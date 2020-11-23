<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterialInformacionPorDefinir extends Model
{
    protected $table = 'obras__tipo_material__informacion_por_definir';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
