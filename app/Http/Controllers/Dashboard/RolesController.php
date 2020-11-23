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
        $this->middleware('VerificarPermiso:creacion_usuarios_permisos');
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
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
                            $eliminar       =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';

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
            $request->merge(['captura_solicitud_obra'               => (($request->has('captura_solicitud_obra'))                   ? ( ($request->input('captura_solicitud_obra') == 'on')                 ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_basica'           => (($request->has('captura_de_registro_basica'))               ? ( ($request->input('captura_de_registro_basica') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_avanzada'         => (($request->has('captura_de_registro_avanzada'))             ? ( ($request->input('captura_de_registro_avanzada') == 'on')           ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_responsables_intervencion' => (($request->has('captura_de_responsables_intervencion'))     ? ( ($request->input('captura_de_responsables_intervencion') == 'on')   ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_catalogos_basica'          => (($request->has('captura_de_catalogos_basica'))              ? ( ($request->input('captura_de_catalogos_basica') == 'on')            ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_catalogos_avanzada'        => (($request->has('captura_de_catalogos_avanzada'))            ? ( ($request->input('captura_de_catalogos_avanzada') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_solicitud_analisis'        => (($request->has('captura_de_solicitud_analisis'))            ? ( ($request->input('captura_de_solicitud_analisis') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_resultados'                => (($request->has('captura_de_resultados'))                    ? ( ($request->input('captura_de_resultados') == 'on')                  ? 1 : 0 ) : 0)]);

            $request->merge(['edicion_de_registro_basica'           => (($request->has('edicion_de_registro_basica'))               ? ( ($request->input('edicion_de_registro_basica') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_1'       => (($request->has('edicion_de_registro_avanzada_1'))           ? ( ($request->input('edicion_de_registro_avanzada_1') == 'on')         ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_2'       => (($request->has('edicion_de_registro_avanzada_2'))           ? ( ($request->input('edicion_de_registro_avanzada_2') == 'on')         ? 1 : 0 ) : 0)]);
            
            $request->merge(['eliminar_solicitud_obra'              => (($request->has('eliminar_solicitud_obra'))                  ? ( ($request->input('eliminar_solicitud_obra') == 'on')                ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_registro'                    => (($request->has('eliminar_registro'))                        ? ( ($request->input('eliminar_registro') == 'on')                      ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_solicitud_analisis'          => (($request->has('eliminar_solicitud_analisis'))              ? ( ($request->input('eliminar_solicitud_analisis') == 'on')            ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_resultados'                  => (($request->has('eliminar_resultados'))                      ? ( ($request->input('eliminar_resultados') == 'on')                    ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_catalogos'                   => (($request->has('eliminar_catalogos'))                       ? ( ($request->input('eliminar_catalogos') == 'on')                     ? 1 : 0 ) : 0)]);
            
            $request->merge(['acceso_a_lista_solicitudes_analisis'  => (($request->has('acceso_a_lista_solicitudes_analisis'))      ? ( ($request->input('acceso_a_lista_solicitudes_analisis') == 'on')    ? 1 : 0 ) : 0)]);
            $request->merge(['acceso_a_lista_solicitudes_obras'     => (($request->has('acceso_a_lista_solicitudes_obras'))         ? ( ($request->input('acceso_a_lista_solicitudes_obras') == 'on')       ? 1 : 0 ) : 0)]);
            $request->merge(['acceso_a_datos_basico'                => (($request->has('acceso_a_datos_basico'))                    ? ( ($request->input('acceso_a_datos_basico') == 'on')                  ? 1 : 0 ) : 0)]);
            $request->merge(['acceso_a_datos_avanzado'              => (($request->has('acceso_a_datos_avanzado'))                  ? ( ($request->input('acceso_a_datos_avanzado') == 'on')                ? 1 : 0 ) : 0)]);
            
            $request->merge(['consulta_general_basica'              => (($request->has('consulta_general_basica'))                  ? ( ($request->input('consulta_general_basica') == 'on')                ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_general_avanzada'            => (($request->has('consulta_general_avanzada'))                ? ( ($request->input('consulta_general_avanzada') == 'on')              ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_externa'                     => (($request->has('consulta_externa'))                         ? ( ($request->input('consulta_externa') == 'on')                       ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_estadistica'                 => (($request->has('consulta_estadistica'))                     ? ( ($request->input('consulta_estadistica') == 'on')                   ? 1 : 0 ) : 0)]);
            
            $request->merge(['imprimir_condicionado'                => (($request->has('imprimir_condicionado'))                    ? ( ($request->input('imprimir_condicionado') == 'on')                  ? 1 : 0 ) : 0)]);
            $request->merge(['imprimir_oficios'                     => (($request->has('imprimir_oficios'))                         ? ( ($request->input('imprimir_oficios') == 'on')                       ? 1 : 0 ) : 0)]);
            
            $request->merge(['creacion_usuarios_permisos'           => (($request->has('creacion_usuarios_permisos'))               ? ( ($request->input('creacion_usuarios_permisos') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['administrar_solicitudes_obras'        => (($request->has('administrar_solicitudes_obras'))            ? ( ($request->input('administrar_solicitudes_obras') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['administrar_solicitudes_analisis'     => (($request->has('administrar_solicitudes_analisis'))         ? ( ($request->input('administrar_solicitudes_analisis') == 'on')       ? 1 : 0 ) : 0)]);
            $request->merge(['administrar_registro_resultados'      => (($request->has('administrar_registro_resultados'))          ? ( ($request->input('administrar_registro_resultados') == 'on')        ? 1 : 0 ) : 0)]);

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
            $request->merge(['captura_solicitud_obra'               => (($request->has('captura_solicitud_obra'))                   ? ( ($request->input('captura_solicitud_obra') == 'on')                 ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_basica'           => (($request->has('captura_de_registro_basica'))               ? ( ($request->input('captura_de_registro_basica') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_registro_avanzada'         => (($request->has('captura_de_registro_avanzada'))             ? ( ($request->input('captura_de_registro_avanzada') == 'on')           ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_responsables_intervencion' => (($request->has('captura_de_responsables_intervencion'))     ? ( ($request->input('captura_de_responsables_intervencion') == 'on')   ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_catalogos_basica'          => (($request->has('captura_de_catalogos_basica'))              ? ( ($request->input('captura_de_catalogos_basica') == 'on')            ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_catalogos_avanzada'        => (($request->has('captura_de_catalogos_avanzada'))            ? ( ($request->input('captura_de_catalogos_avanzada') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_solicitud_analisis'        => (($request->has('captura_de_solicitud_analisis'))            ? ( ($request->input('captura_de_solicitud_analisis') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['captura_de_resultados'                => (($request->has('captura_de_resultados'))                    ? ( ($request->input('captura_de_resultados') == 'on')                  ? 1 : 0 ) : 0)]);

            $request->merge(['edicion_de_registro_basica'           => (($request->has('edicion_de_registro_basica'))               ? ( ($request->input('edicion_de_registro_basica') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_1'       => (($request->has('edicion_de_registro_avanzada_1'))           ? ( ($request->input('edicion_de_registro_avanzada_1') == 'on')         ? 1 : 0 ) : 0)]);
            $request->merge(['edicion_de_registro_avanzada_2'       => (($request->has('edicion_de_registro_avanzada_2'))           ? ( ($request->input('edicion_de_registro_avanzada_2') == 'on')         ? 1 : 0 ) : 0)]);
            
            $request->merge(['eliminar_solicitud_obra'              => (($request->has('eliminar_solicitud_obra'))                  ? ( ($request->input('eliminar_solicitud_obra') == 'on')                ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_registro'                    => (($request->has('eliminar_registro'))                        ? ( ($request->input('eliminar_registro') == 'on')                      ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_solicitud_analisis'          => (($request->has('eliminar_solicitud_analisis'))              ? ( ($request->input('eliminar_solicitud_analisis') == 'on')            ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_resultados'                  => (($request->has('eliminar_resultados'))                      ? ( ($request->input('eliminar_resultados') == 'on')                    ? 1 : 0 ) : 0)]);
            $request->merge(['eliminar_catalogos'                   => (($request->has('eliminar_catalogos'))                       ? ( ($request->input('eliminar_catalogos') == 'on')                     ? 1 : 0 ) : 0)]);
            
            $request->merge(['acceso_a_lista_solicitudes_analisis'  => (($request->has('acceso_a_lista_solicitudes_analisis'))      ? ( ($request->input('acceso_a_lista_solicitudes_analisis') == 'on')    ? 1 : 0 ) : 0)]);
            $request->merge(['acceso_a_lista_solicitudes_obras'     => (($request->has('acceso_a_lista_solicitudes_obras'))         ? ( ($request->input('acceso_a_lista_solicitudes_obras') == 'on')       ? 1 : 0 ) : 0)]);
            $request->merge(['acceso_a_datos_basico'                => (($request->has('acceso_a_datos_basico'))                    ? ( ($request->input('acceso_a_datos_basico') == 'on')                  ? 1 : 0 ) : 0)]);
            $request->merge(['acceso_a_datos_avanzado'              => (($request->has('acceso_a_datos_avanzado'))                  ? ( ($request->input('acceso_a_datos_avanzado') == 'on')                ? 1 : 0 ) : 0)]);
            
            $request->merge(['consulta_general_basica'              => (($request->has('consulta_general_basica'))                  ? ( ($request->input('consulta_general_basica') == 'on')                ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_general_avanzada'            => (($request->has('consulta_general_avanzada'))                ? ( ($request->input('consulta_general_avanzada') == 'on')              ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_externa'                     => (($request->has('consulta_externa'))                         ? ( ($request->input('consulta_externa') == 'on')                       ? 1 : 0 ) : 0)]);
            $request->merge(['consulta_estadistica'                 => (($request->has('consulta_estadistica'))                     ? ( ($request->input('consulta_estadistica') == 'on')                   ? 1 : 0 ) : 0)]);
            
            $request->merge(['imprimir_condicionado'                => (($request->has('imprimir_condicionado'))                    ? ( ($request->input('imprimir_condicionado') == 'on')                  ? 1 : 0 ) : 0)]);
            $request->merge(['imprimir_oficios'                     => (($request->has('imprimir_oficios'))                         ? ( ($request->input('imprimir_oficios') == 'on')                       ? 1 : 0 ) : 0)]);
            
            $request->merge(['creacion_usuarios_permisos'           => (($request->has('creacion_usuarios_permisos'))               ? ( ($request->input('creacion_usuarios_permisos') == 'on')             ? 1 : 0 ) : 0)]);
            $request->merge(['administrar_solicitudes_obras'        => (($request->has('administrar_solicitudes_obras'))            ? ( ($request->input('administrar_solicitudes_obras') == 'on')          ? 1 : 0 ) : 0)]);
            $request->merge(['administrar_solicitudes_analisis'     => (($request->has('administrar_solicitudes_analisis'))         ? ( ($request->input('administrar_solicitudes_analisis') == 'on')       ? 1 : 0 ) : 0)]);
            $request->merge(['administrar_registro_resultados'      => (($request->has('administrar_registro_resultados'))          ? ( ($request->input('administrar_registro_resultados') == 'on')        ? 1 : 0 ) : 0)]);

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
