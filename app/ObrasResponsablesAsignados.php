<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Obras;

class ObrasResponsablesAsignados extends Model
{
    protected $table = 'obras__responsables_asignados';
    protected $fillable = [
    	'obra_id',
    	'usuario_id'
    ];

    public function obra() {
        return $this->hasOne('App\Obras', 'id', 'obra_id');
    }

    public function usuario() {
        return $this->hasOne('App\User', 'id', 'usuario_id');
    }

    public static function reAsignarResponsables($obra_id, $arrayResponsables){
        $obra   =   Obras::find($obra_id);

        if($obra){
            // Recorremos el arreglo de responsables y lo buscamos en la bdd, si ya esta asignado
            // no hacemos nada, si no esta asignado entonces lo creamos
            if(!$arrayResponsables){
                $arrayResponsables                          =   [];
            }

            foreach ($arrayResponsables as $usuario_id) {
                // Buscamos si no esta asignado el usuario
                if(!$obra->responsables_asignados->where('id', $usuario_id)->first()){
                    // Creamos el responsable
                    $obraResponsableAsignado                =   new ObrasResponsablesAsignados;
                    $obraResponsableAsignado->obra_id       =   $obra->id;
                    $obraResponsableAsignado->usuario_id    =   $usuario_id;
                    $obraResponsableAsignado->save();
                }
            }

            // Borramos todos los usuarios asignados que no vengan en el array nuevo
            $usuariosAsignadosViejos                        =   ObrasResponsablesAsignados::where('obra_id', $obra->id)
                                                                                            ->whereNotIn('usuario_id', $arrayResponsables)
                                                                                            ->delete();
        }
    }
}
