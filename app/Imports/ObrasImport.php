<?php

namespace App\Imports;

use App\Areas;
use App\Obras;
use App\ObrasTemporalidad;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class ObrasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Si recibimos una temporalidad id como numero entonces es el id
        // si no entonces tenemos que crearla
        if(is_numeric($row['temporalidad_id']) || $row['temporalidad_id'] == ""){
            $temporalidad_id                    =   $row['temporalidad_id'];
        } else{

            // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
            // entonces lo creamos
            $temporalidad                       =   ObrasTemporalidad::where('nombre', 'like', '%'.$row['temporalidad_id'].'%')->first();
            if($temporalidad){
                $temporalidad_id                =   $temporalidad->id;
            } else{
                $temporalidadN                  =   new ObrasTemporalidad;
                $temporalidadN->nombre          =   $row['temporalidad_id'];
                $temporalidadN->save();
                $temporalidadN->refresh();

                $temporalidad_id                =   $temporalidadN->id;
            }

            
        }

        if(is_numeric($row['area_id']) || $row['area_id'] == ""){
            $area_id                            =   $row['area_id'];
        } else{

            // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
            // entonces lo creamos
            $area                               =   Areas::where('nombre', 'like', '%'.$row['area_id'].'%')->first();
            if($area){
                $area_id                        =   $area->id;
            } else{
                $areaN                          =   new Areas;
                $areaN->nombre                  =   $row['area_id'];
                $areaN->save();
                $areaN->refresh();

                $area_id                        =   $areaN->id;
            }
        }

        try {
            $obra   =    new Obras([
                                    'usuario_solicito_id'           =>  Auth::id(),
                                    'usuario_aprobo_id'             =>  Auth::id(),
                                    'tipo_objeto_id'                =>  $row['tipo_objeto_id'],
                                    'tipo_bien_cultural_id'         =>  $row['tipo_bien_cultural_id'],
                                    'epoca_id'                      =>  $row['epoca_id'],
                                    'temporalidad_id'               =>  $temporalidad_id,
                                    'area_id'                       =>  $area_id,
                                    'usuario_recibio_id'            =>  Auth::id(),
                                    'proyecto_id'                   =>  $row['proyecto_id'],
                                    'nombre'                        =>  $row['nombre'],
                                    'autor'                         =>  $row['autor'],
                                    'cultura'                       =>  $row['cultura'],
                                    'lugar_procedencia_actual'      =>  $row['lugar_procedencia_actual'],
                                    'numero_inventario'             =>  $row['numero_inventario'],
                                    'año'                           =>  $row['ano'],
                                    'estatus_año'                   =>  $row['estatus_ano'],
                                    'estatus_epoca'                 =>  $row['estatus_epoca'],
                                    'alto'                          =>  ($row['alto'] ?? 0),
                                    'diametro'                      =>  ($row['diametro'] ?? 0),
                                    'profundidad'                   =>  ($row['profundidad'] ?? 0),
                                    'ancho'                         =>  ($row['ancho'] ?? 0),
                                    'fecha_ingreso'                 =>  $row['fecha_ingreso'],
                                    'fecha_salida'                  =>  $row['fecha_salida'],
                                    'modalidad'                     =>  $row['modalidad'],
                                    'caracteristicas_descriptivas'  =>  $row['caracteristicas_descriptivas'],
                                    'lugar_procedencia_original'    =>  $row['lugar_procedencia_original'],
                                    'forma_ingreso'                 =>  $row['forma_ingreso'],
                                    'fecha_aprobacion'              =>  Carbon::now()
                                ]);

            $obra->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return null;
        }
        
    }
}
