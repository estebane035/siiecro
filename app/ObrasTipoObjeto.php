<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoObjeto extends Model
{
    protected $table = "obras__tipo_objeto";
    protected $fillable = [
    	'nombre'
    ];
}
