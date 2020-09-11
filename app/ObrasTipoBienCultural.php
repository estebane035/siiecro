<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoBienCultural extends Model
{
    protected $table = "obras__tipo_bien_cultural";
    protected $fillable = [
    	'nombre'
    ];
}
