<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Proyectos;
use App\ProyectosTemporadasTrabajo;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

class ProyectosTemporadasTrabajoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function cargarTabla(Request $request, $proyecto_id){
        $registros      =   ProyectosTemporadasTrabajo::where('proyecto_id', $proyecto_id);

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
                            $eliminar       =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request){
        $registro   =   new ProyectosTemporadasTrabajo;
        return view('dashboard.proyectos.temporadas-trabajo.agregar', ["registro" => $registro]);
    }

    public function store(Request $request){
        if($request->ajax()){
            return BD::crear('ProyectosTemporadasTrabajo', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro   =   ProyectosTemporadasTrabajo::findOrFail($id);
        return view('dashboard.proyectos.temporadas-trabajo.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            $data   		= 	$request->all();
            return BD::actualiza($id, "ProyectosTemporadasTrabajo", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   ProyectosTemporadasTrabajo::findOrFail($id);
        return view('dashboard.proyectos.temporadas-trabajo.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "ProyectosTemporadasTrabajo");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function select2(Request $request){
        if($request->ajax()){
            $proyecto_id        =   $request->input('proyecto_id');

            $temporadas         =   ProyectosTemporadasTrabajo::selectRaw("proyectos__temporadas_trabajo.*")
                                                            ->where('proyecto_id', $proyecto_id)
                                                            ->get();

            $array              =   [];

            $a                  =   [];
            $a["id"]            =   "";
            $a["text"]          =   "";
            array_push($array, $a);

            foreach ($temporadas as $temporada) {
                $a              =   [];
                $a["id"]        =   $temporada->id;
                $a["text"]      =   $temporada->numero_temporada." [".$temporada->año."]";

                array_push($array, $a);
            }

            return json_encode($array);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
