<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\Roles;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $titulo         =   "Roles";
        
        return view("dashboard.roles.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   Roles::all();

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
        $registro   =   new Roles;
        return view('dashboard.roles.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('Roles', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   Roles::findOrFail($id);
        return view('dashboard.roles.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            return BD::actualiza($id, "Roles", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   Roles::findOrFail($id);
        return view('dashboard.roles.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "Roles");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
