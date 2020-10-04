<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cadenas;

class Obras extends Model
{
    protected $fillable = [
        'usuario_solicito_id',
        'usuario_aprobo_id',
        'usuario_rechazo_id',
        'usuario_recibio_id',
        'epoca_id',
        'temporalidad_id',
        'tipo_objeto_id',
        'tipo_bien_cultural_id',
        'area_id',
        'responsable_id',
        'nombre',
        'autor',
        'cultura',
        'alto',
        'largo',
        'ancho',
        'diametro',
        'fecha_ingreso',
        'fecha_salida',
        'modalidad',
        'persona_entrego',
        'vista_frontal',
        'vista_posterior',
        'vista_lateral_derecha',
        'vista_lareral_izquierda',
        'caracteristicas_descriptivas',
        'lugar_procedencia_original',
        'forma_ingreso',
        'lugar_procedencia_actual',
        'numero_inventario',
        'estatus_año',
        'estatus_epoca',
        'año',
        'fecha_aprobacion',
        'fecha_rechazo',
    ];
    
    protected $dates = [
        'año',
        'fecha_aprobacion',
        'fecha_rechazo',
        'fecha_ingreso',
        'fecha_salida'
    ];

    public function setAñoAttribute($value){
        if($value){
            $this->attributes['año']    =   Carbon::parse($value);
        } else{
            $this->attributes['año']    =   NULL;
        }
    }

    public function setFechaAprobacionAttribute($value){
        if($value){
            $this->attributes['fecha_aprobacion']   =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_aprobacion']   =   NULL;
        }
    }

    public function setFechaRechazoAttribute($value){
        if($value){
            $this->attributes['fecha_rechazo']  =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_rechazo']  =   NULL;
        }
    }

    public function setFechaIngresoAttribute($value){
        if($value){
            $this->attributes['fecha_ingreso']  =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_ingreso']  =   NULL;
        }
    }

    public function setFechaSalidaAttribute($value){
        if($value){
            $this->attributes['fecha_salida']   =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_salida']   =   NULL;
        }
    }

    public function getFolioAttribute(){
        $folio          =   str_pad($this->id, 4, "0", STR_PAD_LEFT);

        if($this->año){
            $folio      .=  "-".$this->año->format('y')."/";
        }else{
            $folio      .=  "-00/";
        }

        $folio          .=  $this->forma_ingreso."-";

        if($this->modalidad){
            $folio      .=  Cadenas::obtenerSiglasDeCadena($this->modalidad)."-";
        }

        if($this->area){
            $folio      .=  $this->area->siglas;
        }


        // return $this->id."-20/INT-STRPM";
        return $folio;
    }

    public function usuario_aprobo() {
        return $this->hasOne('App\Users', 'id', 'usuario_aprobo_id');
    }

    public function usuario_rechazo() {
        return $this->hasOne('App\Users', 'id', 'usuario_rechazo_id');
    }

    public function usuario_solicito() {
        return $this->hasOne('App\Users', 'id', 'usuario_solicito_id');
    }

    public function epoca() {
        return $this->hasOne('App\ObrasEpoca', 'id', 'epoca_id');
    }

    public function temporalidad() {
        return $this->hasOne('App\ObrasTemporalidad', 'id', 'temporalidad_id');
    }

    public function tipo_objeto() {
        return $this->hasOne('App\ObrasTipoObjeto', 'id', 'tipo_objeto_id');
    }

    public function tipo_bien_cultural() {
        return $this->hasOne('App\ObrasTipoBienCultural', 'id', 'bien_cultural_id');
    }

    public function area() {
        return $this->hasOne('App\Areas', 'id', 'area_id');
    }

    public function responsables_asignados() {
        return $this->hasManyThrough(
            'App\User',
            'App\ObrasResponsablesAsignados',
            'obra_id', // Llave foranea de primer tabla con segunda tabla
            'id', // Llave foranea de segunda tabla con tercera tabla
            'id', // llave foranea de segunda tabla con primera tabla
            'usuario_id' // llave foranea de tercera tabla con segunda tabla
        );
    }
}
