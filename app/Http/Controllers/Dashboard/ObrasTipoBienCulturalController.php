<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasTipoBienCultural;

class ObrasTipoBienCulturalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada|captura_de_catalogos_basica');
        $this->middleware('VerificarPermiso:eliminar_catalogos',    ["only" =>  ["eliminar", "destroy"]]);
    }
    
    public function index(){
        $titulo         =   "Obras Tipo Bien Cultural";
        
        return view("dashboard.obras.tipo-bien-cultural.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   ObrasTipoBienCultural::all();

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
                            $eliminar       =   '';

                            if(Auth::user()->rol->eliminar_catalogos){
                                $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                            }

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request)
    {
        $registro   =   new ObrasTipoBienCultural;
        return view('dashboard.obras.tipo-bien-cultural.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){

            if($request->has('calcular_temporalidad')){
                $request->merge(['calcular_temporalidad' => "si"]);
            } else{
                $request->merge(['calcular_temporalidad' => "no"]);
            }

            return BD::crear('ObrasTipoBienCultural', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasTipoBienCultural::findOrFail($id);
        return view('dashboard.obras.tipo-bien-cultural.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){

            if($request->has('calcular_temporalidad')){
                $request->merge(['calcular_temporalidad' => "si"]);
            } else{
                $request->merge(['calcular_temporalidad' => "no"]);
            }
            
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoBienCultural", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasTipoBienCultural::findOrFail($id);
        return view('dashboard.obras.tipo-bien-cultural.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoBienCultural");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
