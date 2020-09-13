<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTemporalidad extends Model
{
    protected $table = 'obras__temporalidad';
    protected $fillable = [
    	'nombre'
    ];
}
