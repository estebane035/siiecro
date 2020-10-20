<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Proyectos;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;


class ProyectosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $titulo         =   "Proyectos";
        
        return view("dashboard.proyectos.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
        $registros      =   Proyectos::all();

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
        $registro   =   new Proyectos;
        return view('dashboard.proyectos.agregar', ["registro" => $registro]);
    }

    public function store(Request $request){
        if($request->ajax()){

        	// Agregamos un seo temporal
        	$request->merge(["seo" => "temp"]);

            $response 		= 	BD::crear('Proyectos', $request);
            
            // Si se guardo bien generamos el seo
            if($response->status() == 200 || $response->status() == 201){
            	$proyecto 	= 	Proyectos::find($response->getOriginalContent()->id);
            	$proyecto->generaSeo();
            }

            return $response;
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro   =   Proyectos::findOrFail($id);
        return view('dashboard.proyectos.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){

        	$request->merge(["seo" => "1"]);
            $data   		= 	$request->all();
            $response 		= 	BD::actualiza($id, "Proyectos", $data);

            // Si se guardo bien generamos el seo
            if($response->status() == 200){
            	$proyecto 	= 	Proyectos::find($id);
            	$proyecto->generaSeo();
            }

            return $response;
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   Proyectos::findOrFail($id);
        return view('dashboard.proyectos.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "Proyectos");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
