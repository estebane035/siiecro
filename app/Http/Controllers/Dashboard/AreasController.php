<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\Areas;

class AreasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada');
    }
    
    public function index(){
    	$titulo 		= 	"Áreas";
    	
    	return view("dashboard.areas.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	Areas::all();

    	return DataTables::of($registros)
    					->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
                            $eliminar   	=   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function create(Request $request){
        $registro   =   new Areas;
        return view('dashboard.areas.agregar', ["registro" => $registro]);
    }

    public function store(Request $request){
        if($request->ajax()){
            return BD::crear('Areas', $request);
        }
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro   =   Areas::findOrFail($id);
        return view('dashboard.areas.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            $data   =  $request->all();
            return BD::actualiza($id, "Areas", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   Areas::findOrFail($id);
        return view('dashboard.areas.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "Areas");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
