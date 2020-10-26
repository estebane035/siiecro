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

    public function getFolioAttribute(){
        $folio          =   str_pad($this->id, 4, "0", STR_PAD_LEFT);

        // if($this->año){
        //     $folio      .=  "-".$this->año->format('y')."/";
        // }else{
        //     $folio      .=  "-00/";
        // }

        // $folio          .=  $this->forma_ingreso."-";

        // if($this->modalidad){
        //     $folio      .=  Cadenas::obtenerSiglasDeCadena($this->modalidad)."-";
        // }

        // if($this->area){
        //     $folio      .=  $this->area->siglas;
        // }

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
