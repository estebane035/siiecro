<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasSolicitudesAnalisis extends Model
{
    protected $table = 'obras__solicitudes_analisis';
    protected $fillable = [
    	'id',
    	'obra_id',
        'creo_usuario_id',
        'usuario_aprobo_id',
        'usuario_rechazo_id',
        'usuario_reviso_id',
    	'obra_usuario_asignado_id',
    	'tecnica',
    	'fecha_intervencion',
        'estatus',
        'fecha_aprobacion',
        'fecha_rechazo',
        'fecha_revision',
    ];

    public function tipo_analisis() {
        return $this->hasOne('App\ObrasSolicitudesAnalisisTipoAnalisis', 'id', 'obra_id');
    }

    public function reponsable_solicitud() {
        return $this->hasOne('App\ObrasUsuariosAsignados', 'usuario_id', 'obra_usuario_asignado_id');
    }

    public function imagenes_esquema() {
        return $this->hasMany('App\ObrasSolicitudesAnalisisImagenesEsquema', 'solicitud_analisis_id', 'id');
    }
}
