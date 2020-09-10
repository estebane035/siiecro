<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\User;
use App\Roles;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	$titulo 		= 	"Usuarios";
    	
    	return view("dashboard.usuarios.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	User::selectRaw('
                                                users.id,
                                                users.name,
                                                users.email,
                                                roles.nombre as rol
                                            ')
                                            ->join('roles', 'roles.id', '=', 'users.rol_id')
                                            ->get();

    	return DataTables::of($registros)
    					->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i>';

                            // No se puede eliminar el usuario en sesion
                            if(Auth::id() == $registro->id){
                                $eliminar   =   "";
                            } else{
                                $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';
                            }

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function create(Request $request){
        $registro   =   new User;
        $roles      =   Roles::all();
        return view('dashboard.usuarios.agregar', ["registro" => $registro, "roles" => $roles]);
    }

    public function store(Request $request){
        if($request->ajax()){
            if($request->input('contraseña') != $request->input('repetir_contraseña')){
                return Response::json(["mensaje" => "Las contraseñas no coinciden.", "error" => true], 200);
            } else{
                $request->merge(["password" => Hash::make($request->input('contraseña'))]);
            }

            return BD::crear('User', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro   =   User::findOrFail($id);
        $roles      =   Roles::all();
        return view('dashboard.usuarios.agregar', ["registro" => $registro, "roles" => $roles]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            // Si recibimos contraseña debemos verificar que sean iguales
            // Si no entonces omitimos la contraseña en el request
            if($request->input('contraseña') != ""){
                if($request->input('contraseña') != $request->input('repetir_contraseña')){
                    return Response::json(["mensaje" => "Las contraseñas no coinciden.", "error" => true], 200);
                } else{
                    $request->merge(["password" => Hash::make($request->input('contraseña'))]);
                    $data   =   $request->all();
                }
            } else{
                $data       =   $request->except(["contraseña"]);
            }

            
            return BD::actualiza($id, "User", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   User::findOrFail($id);
        return view('dashboard.usuarios.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "User");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
