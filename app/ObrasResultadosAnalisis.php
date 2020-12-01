<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasResultadosAnalisis extends Model
{
    protected $table = 'obras__resultados_analisis';
    protected $fillable = [
    	'id',
    	'solicitudes_analisis_muestras_id',
        'forma_obtencion_muestra_id',
        'tipo_material_id',
        'informacion_por_definir_id',
        'interpretacion_particular_id',
        
        'fecha_analisis',
        'profesor_responsable_de_analisis',
    	'persona_realiza_analisis',
        'ubicacion_de_toma_muestra',
        'descripcion',
        'ruta_acceso_microfotografia',
        'conclusion_general',
    ];

    public function imagenes_resultados_esquema_muestra() {
        return $this->hasMany('App\ObrasResultadosAnalisisEsquemaMuestra', 'resultado_analisis_id', 'id');
    }

    public function imagenes_resultados_esquema_microfotografia() {
        return $this->hasMany('App\ObrasResultadosAnalisisEsquemaMicrofotografia', 'resultado_analisis_id', 'id');
    }
}