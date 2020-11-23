<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasAnalisisARealizarResultados extends Model
{
    protected $table = 'obras__analisis_a_realizar_resultados';
    protected $fillable = [
    	'id',
    	'resultado_analisis_id',
    	'analisis_a_realizar_id',
    	'tecnica_analitica_id',
    	'interpretacion',
    	'descripciones',
    	'datos',
    	'info_del_equipo',
    	'ruta_acceso_imagen',
    	'ruta_acceso_datos',
    ];

    public function esquema_analiticos_microfotografias() {
        return $this->hasMany('App\ObrasAnalisisARealizarMicrofotografia', 'analisis_a_realizar_resultado_id', 'id');
    }
}
