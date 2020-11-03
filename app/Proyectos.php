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

    public function area() {
        return $this->hasOne('App\Areas', 'id', 'area_id');
    }

    public function getFolioAttribute(){
        $folio          =   str_pad($this->id, 4, "0", STR_PAD_LEFT)."/".$this->area->siglas."-".$this->forma_ingreso;

        return $folio;
    }

    public function generaSeo(){
    	$this->seo 	= 	Cadenas::generarSeo($this->nombre, $this->id);
    	$this->save();
    }

    public function etiquetaFolio(){
        $clase  =   $this->status == "Abierto" ? "success" : "danger";

        return '<span class="label label-'.$clase.'">'.$this->folio.'</span>';
    }
}
