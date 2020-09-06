<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use BD;
use Response;

use App\User;

class UsuariosController extends Controller
{
    public function index(){
    	$titulo 		= 	"Usuarios";
    	
    	return view("dashboard.usuarios.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	User::all();

    	return DataTables::of($registros)
    					->addColumn('acciones', function($registro){
                            $editar         =   '<i class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i>';
                            $eliminar       =   '<i class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function create(Request $request){
        $registro   =   new User;
        return view('dashboard.usuarios.agregar', ["registro" => $registro]);
    }

    public function store(Request $request){
        if($request->input('contraseña') != $request->input('repetir_contraseña')){
            return Response::json(["mensaje" => "Las contraseñas no coinciden.", "error" => true], 200);
        } else{
            $request->merge(["password" => $request->input('contraseña')]);
        }

        return BD::crear('User', $request);
    }

    public function edit(Request $request, $id){

    }

    public function update(Request $request, $id){

    }

    public function eliminar(Request $request, $id){

    }

    public function destroy(Request $request, $id){

    }
}
