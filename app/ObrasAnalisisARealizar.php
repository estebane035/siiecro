<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasAnalisisARealizar extends Model
{
    protected $table = 'obras__analisis_a_realizar';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
