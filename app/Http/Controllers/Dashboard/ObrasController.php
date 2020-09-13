<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\Obras;
use App\ObrasTipoBienCultural;
use App\ObrasTipoObjeto;

class ObrasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
    	$titulo 		= 	"Obras";
    	
    	return view("dashboard.obras.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	Obras::all();

    	return DataTables::of($registros)
    					->addColumn('folio', function($registro){
    						return $registro->folio;
    					})
    					->addColumn('acciones', function($registro){
                            $editar         =   '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->id).'"><i class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i></a>';
                            $eliminar   	=   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function create(Request $request){
        $registro               =   new Obras;
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        return view('dashboard.obras.agregar', ["registro" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto]);
    }

    public function store(Request $request){
        if($request->ajax()){
            $respuesta          =   BD::crear('Obras', $request);

            // Si se guardo bien le agregamos la ruta de la obra para que redireccione
            if($respuesta->status() == 201){
                $data           =   $respuesta->getdata();
                $ruta           =   route('dashboard.obras.show', $data->id);
                $data->url      =   $ruta;
                $respuesta->setData($data);
                return $respuesta;
            }
        }
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro               =   Obras::findOrFail($id);
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        return view('dashboard.obras.agregar', ["registro" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            return BD::actualiza($id, "Obras", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "Obras");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function show(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.detalle.detalle', ["obra" => $registro]);
    }
}
