<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    protected $fillable = [
        'usuario_solicito_id',
        'usuario_aprobo_id',
        'usuario_rechazo_id',
        'epoca_id',
        'temporalidad_id',
        'tipo_objeto_id',
        'tipo_bien_cultural_id',
        'nombre',
        'autor',
        'cultura',
        'alto',
        'largo',
        'ancho',
        'lugar_procedencia_actual',
        'numero_inventario',
        'estatus_año',
        'estatus_epoca',
    ];
    
    protected $dates = [
        'año',
        'fecha_aprobacion',
        'fecha_rechazo'
    ];

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

    public function getFolioAttribute(){
    	return $this->id."-20/INT-STRPM";
    }
}
