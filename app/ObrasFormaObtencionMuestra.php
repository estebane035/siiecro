<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasFormaObtencionMuestra extends Model
{
    protected $table = 'obras__forma_obtencion_muestra';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
