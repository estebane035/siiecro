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
            $request->merge(['captura_de_registro_basica'       => (($request->has('captura_de_registro_basica'))       ? ( ($request->input('captura_de_registro_basica') == 'on')     ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_avanzada_1'   => (($request->has('captura_de_registro_avanzada_1'))   ? ( ($request->input('captura_de_registro_avanzada_1') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_avanzada_2'   => (($request->has('captura_de_registro_avanzada_2'))   ? ( ($request->input('captura_de_registro_avanzada_2') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_solicitud'             => (($request->has('captura_de_solicitud'))             ? ( ($request->input('captura_de_solicitud') == 'on')           ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_resultados_basica'     => (($request->has('captura_de_resultados_basica'))     ? ( ($request->input('captura_de_resultados_basica') == 'on')   ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_resultados_avanzada'   => (($request->has('captura_de_resultados_avanzada'))   ? ( ($request->input('captura_de_resultados_avanzada') == 'on') ? 1 : 0 ) : 0)]);

            $request->merge(['edicion_de_registro_basica'       => (($request->has('edicion_de_registro_basica'))       ? ( ($request->input('edicion_de_registro_basica') == 'on')     ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_1'   => (($request->has('edicion_de_registro_avanzada_1'))   ? ( ($request->input('edicion_de_registro_avanzada_1') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_2'   => (($request->has('edicion_de_registro_avanzada_2'))   ? ( ($request->input('edicion_de_registro_avanzada_2') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_solicitud'             => (($request->has('edicion_de_solicitud'))             ? ( ($request->input('edicion_de_solicitud') == 'on')           ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_resultados_basica'     => (($request->has('edicion_de_resultados_basica'))     ? ( ($request->input('edicion_de_resultados_basica') == 'on')   ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_resultados_avanzada'   => (($request->has('edicion_de_resultados_avanzada'))   ? ( ($request->input('edicion_de_resultados_avanzada') == 'on') ? 1 : 0 ) : 0)]);
            
            $request->merge(['eliminar_registro'                => (($request->has('eliminar_registro'))                ? ( ($request->input('eliminar_registro') == 'on')              ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_solicitud'               => (($request->has('eliminar_solicitud'))               ? ( ($request->input('eliminar_solicitud') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_resultados'              => (($request->has('eliminar_resultados'))              ? ( ($request->input('eliminar_resultados') == 'on')            ? 1 : 0 ) : 0)]);
            
            $request->merge(['consulta_general_basica'          => (($request->has('consulta_general_basica'))          ? ( ($request->input('consulta_general_basica') == 'on')        ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_general_avanzada_1'      => (($request->has('consulta_general_avanzada_1'))      ? ( ($request->input('consulta_general_avanzada_1') == 'on')    ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_general_avanzada_2'      => (($request->has('consulta_general_avanzada_2'))      ? ( ($request->input('consulta_general_avanzada_2') == 'on')    ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_externa'                 => (($request->has('consulta_externa'))                 ? ( ($request->input('consulta_externa') == 'on')               ? 1 : 0 ) : 0)]);
            $request->merge(['imprimir_condicionado'            => (($request->has('imprimir_condicionado'))            ? ( ($request->input('imprimir_condicionado') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['imprimir'                         => (($request->has('imprimir'))                         ? ( ($request->input('imprimir') == 'on')                       ? 1 : 0 ) : 0)]);
            
            $request->merge(['admin_de_usuarios'                => (($request->has('admin_de_usuarios'))                ? ( ($request->input('admin_de_usuarios') == 'on')              ? 1 : 0 ) : 0)]);

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
            $request->merge(['captura_de_registro_basica'       => (($request->has('captura_de_registro_basica'))       ? ( ($request->input('captura_de_registro_basica') == 'on')     ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_avanzada_1'   => (($request->has('captura_de_registro_avanzada_1'))   ? ( ($request->input('captura_de_registro_avanzada_1') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_avanzada_2'   => (($request->has('captura_de_registro_avanzada_2'))   ? ( ($request->input('captura_de_registro_avanzada_2') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_solicitud'             => (($request->has('captura_de_solicitud'))             ? ( ($request->input('captura_de_solicitud') == 'on')           ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_resultados_basica'     => (($request->has('captura_de_resultados_basica'))     ? ( ($request->input('captura_de_resultados_basica') == 'on')   ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_resultados_avanzada'   => (($request->has('captura_de_resultados_avanzada'))   ? ( ($request->input('captura_de_resultados_avanzada') == 'on') ? 1 : 0 ) : 0)]);
           
            $request->merge(['edicion_de_registro_basica'       => (($request->has('edicion_de_registro_basica'))       ? ( ($request->input('edicion_de_registro_basica') == 'on')     ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_1'   => (($request->has('edicion_de_registro_avanzada_1'))   ? ( ($request->input('edicion_de_registro_avanzada_1') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_2'   => (($request->has('edicion_de_registro_avanzada_2'))   ? ( ($request->input('edicion_de_registro_avanzada_2') == 'on') ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_solicitud'             => (($request->has('edicion_de_solicitud'))             ? ( ($request->input('edicion_de_solicitud') == 'on')           ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_resultados_basica'     => (($request->has('edicion_de_resultados_basica'))     ? ( ($request->input('edicion_de_resultados_basica') == 'on')   ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_resultados_avanzada'   => (($request->has('edicion_de_resultados_avanzada'))   ? ( ($request->input('edicion_de_resultados_avanzada') == 'on') ? 1 : 0 ) : 0)]);

            $request->merge(['eliminar_registro'                => (($request->has('eliminar_registro'))                ? ( ($request->input('eliminar_registro') == 'on')              ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_solicitud'               => (($request->has('eliminar_solicitud'))               ? ( ($request->input('eliminar_solicitud') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_resultados'              => (($request->has('eliminar_resultados'))              ? ( ($request->input('eliminar_resultados') == 'on')            ? 1 : 0 ) : 0)]);

            $request->merge(['consulta_general_basica'          => (($request->has('consulta_general_basica'))          ? ( ($request->input('consulta_general_basica') == 'on')        ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_general_avanzada_1'      => (($request->has('consulta_general_avanzada_1'))      ? ( ($request->input('consulta_general_avanzada_1') == 'on')    ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_general_avanzada_2'      => (($request->has('consulta_general_avanzada_2'))      ? ( ($request->input('consulta_general_avanzada_2') == 'on')    ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_externa'                 => (($request->has('consulta_externa'))                 ? ( ($request->input('consulta_externa') == 'on')               ? 1 : 0 ) : 0)]);
            $request->merge(['imprimir_condicionado'            => (($request->has('imprimir_condicionado'))            ? ( ($request->input('imprimir_condicionado') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['imprimir'                         => (($request->has('imprimir'))                         ? ( ($request->input('imprimir') == 'on')                       ? 1 : 0 ) : 0)]);
            
            $request->merge(['admin_de_usuarios'                => (($request->has('admin_de_usuarios'))                ? ( ($request->input('admin_de_usuarios') == 'on')              ? 1 : 0 ) : 0)]);

            $data   = $request->all();
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
