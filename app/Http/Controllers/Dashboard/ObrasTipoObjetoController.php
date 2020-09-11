<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasTipoObjeto;

class ObrasTipoObjetoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $titulo         =   "Obras Tipo Objeto";
        
        return view("dashboard.obras.tipo-objeto.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   ObrasTipoObjeto::all();

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i>';
                            $eliminar       =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request)
    {
        $registro   =   new ObrasTipoObjeto;
        return view('dashboard.obras.tipo-objeto.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoObjeto', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasTipoObjeto::findOrFail($id);
        return view('dashboard.obras.tipo-objeto.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoObjeto", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasTipoObjeto::findOrFail($id);
        return view('dashboard.obras.tipo-objeto.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoObjeto");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
