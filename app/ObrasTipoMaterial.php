<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterial extends Model
{
    protected $table = 'obras__tipo_material';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
