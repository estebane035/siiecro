<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasUsuariosAsignados;
use App\User;

class ObrasUsuariosAsignadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cargarTabla(Request $request, $obra_id)
    {   
        $registros      =   User::selectRaw('
                                                users.*,
                                                oua.id      as obra_usuario_asignado_id,
                                                r.nombre    as rol
                                            ')
                                ->join('roles as r', 'r.id', 'users.rol_id')
                                ->join('obras__usuarios_asignados as oua', 'oua.usuario_id', 'users.id')
                                ->where('oua.obra_id', $obra_id);

        return DataTables::of($registros)
                        ->editColumn('name', function($registro){
                            return $registro->name.$registro->icono_es_responsable_intervencion;
                        })
                        ->addColumn('acciones', function($registro){
                            $eliminar       =   '<i onclick="eliminarUsuarioAsignado('.$registro->obra_usuario_asignado_id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';

                            return $eliminar;
                        })
                        ->rawColumns(['acciones', 'name'])
                        ->make('true');
    }

    public function create(Request $request, $obra_id)
    {
        $registro   =   new ObrasUsuariosAsignados;
        $usuarios 	= 	User::whereRaw("
	        								(
	        									SELECT
	        										id
	        									FROM
	        										obras__usuarios_asignados as oua
	        									WHERE
	        										oua.usuario_id 	= 	users.id 	AND
	        										oua.obra_id 	=	".$obra_id."
	        									LIMIT 1 	
	        								) IS NULL
        								")
        						->get();
        return view('dashboard.obras.detalle.usuarios-asignados.agregar', ["usuariosParaAsignar" => $usuarios, "obra_id" => $obra_id]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasUsuariosAsignados', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasUsuariosAsignados::findOrFail($id);
        return view('dashboard.obras.detalle.usuarios-asignados.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasUsuariosAsignados");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
