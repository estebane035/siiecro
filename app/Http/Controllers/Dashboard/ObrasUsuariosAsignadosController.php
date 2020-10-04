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
        $registros      =   ObrasUsuariosAsignados::selectRaw('
        														obras__usuarios_asignados.*,
        														u.name as nombre
        													')
        											->join('users as u', 'u.id', 'obras__usuarios_asignados.usuario_id')
        											->where('obras__usuarios_asignados.obra_id', $obra_id);

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $eliminar       =   '<i onclick="eliminarUsuarioAsignado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';

                            return $eliminar;
                        })
                        ->rawColumns(['acciones'])
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
