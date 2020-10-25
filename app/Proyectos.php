<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cadenas;

class Proyectos extends Model
{
    protected $table = "proyectos";
    protected $fillable = [
    	'id',
        'area_id',
        'nombre',
        'seo',
        'forma_ingreso',
        'status'
    ];

    public function generaSeo(){
    	$this->seo 	= 	Cadenas::generarSeo($this->nombre, $this->id);
    	$this->save();
    }
}
