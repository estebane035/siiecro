<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasEpoca extends Model
{
    protected $table = 'obras__epoca';
    protected $fillable = [
    	'nombre'
    ];
}
