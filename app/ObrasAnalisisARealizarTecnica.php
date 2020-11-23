<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasAnalisisARealizarTecnica extends Model
{
    protected $table = 'obras__analisis_a_realizar_tecnica';
    protected $fillable = [
    	'id',
    	'analisis_a_realizar_id',
    	'nombre',
    ];
}
