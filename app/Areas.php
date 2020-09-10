<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $fillable = [
        'campo', 
        'nombre',
        'siglas'
    ];
}
