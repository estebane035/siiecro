<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTemporadasTrabajoAsignadas extends Model
{
    protected $table = 'obras__temporadas_trabajo_asignadas';
    protected $fillable = [
    	'obra_id',
    	'proyecto_temporada_trabajo_id'
    ];

    public function obra() {
        return $this->hasOne('App\Obras', 'id', 'obra_id');
    }

    public function temporada_trabajo() {
        return $this->hasOne('App\ProyectosTemporadasTrabajo', 'id', 'proyecto_temporada_trabajo_id');
    }

    public static function reAsignarTemporadas($obra_id, $arrayTemporadas){
    	$obra   =   Obras::find($obra_id);

        if($obra){
            // Recorremos el arreglo de temporadas y lo buscamos en la bdd, si ya esta asignado
            // no hacemos nada, si no esta asignado entonces lo creamos
            if(!$arrayTemporadas){
                $arrayTemporadas                          						=   [];
            }

            foreach ($arrayTemporadas as $temporada_id) {
                // Buscamos si no esta asignada la temporada
                if(!$obra->temporadas_trabajo_asignadas->where('id', $temporada_id)->first()){
                    $temporadaTrabajoAsignada                					=   new ObrasTemporadasTrabajoAsignadas;
                    $temporadaTrabajoAsignada->obra_id       					=   $obra->id;
                    $temporadaTrabajoAsignada->proyecto_temporada_trabajo_id 	=   $temporada_id;
                    $temporadaTrabajoAsignada->save();
                }
            }

            // Borramos todas las temporadas de trabajo asignadas que no vengan en el array nuevo
            $temporadasSinAsignar                        						=   ObrasTemporadasTrabajoAsignadas::where('obra_id', $obra->id)
						                                                                                            ->whereNotIn('proyecto_temporada_trabajo_id', $arrayTemporadas)
						                                                                                            ->delete();
        }
    }
}
