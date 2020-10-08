<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasSolicitudesAnalisis;
use App\ObrasSolicitudesAnalisisMuestras;
use App\ObrasSolicitudesAnalisisTipoAnalisis;
use App\ObrasUsuariosAsignados;
// use App\User;

class ObrasSolicitudesAnalisisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function cargarTabla(Request $request, $obra_id)
    {
        $registros      =   ObrasSolicitudesAnalisis::selectRaw('
                                                                    obras__solicitudes_analisis.id,
                                                                    obras__solicitudes_analisis.tecnica,
                                                                    obras__solicitudes_analisis.fecha_intervencion,
                                                                    users.name,
                                                                    obras__solicitudes_analisis.esquema
                                                                ')
                                                    ->join('users', 'users.id','=', 'obras__solicitudes_analisis.obra_usuario_asignado_id')
                                                    ->where('obras__solicitudes_analisis.obra_id', '=', $obra_id)
                                                    ->get();

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $muestra        =   '<i onclick="verMuestras('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Ver todas las muestras"></i>';
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Editar solicitud de analisis"></i>';
                            $eliminar       =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eliminar solicitud de analisis"></i>';

                            return $muestra.$editar.$eliminar;
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request)
    {
        $registro   =   new ObrasSolicitudesAnalisis;
        $responsables_intervencion = ObrasUsuariosAsignados::selectRaw('
                                                                        users.id,
                                                                        users.name
                                                                        ')
                                                            ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                                            ->get();

        return view('dashboard.obras.detalle.solicitudes-analisis.agregar', ["registro" => $registro, 'responsables_intervencion' => $responsables_intervencion]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            $request->merge([
                                "creo_usuario_id"   =>  Auth::id()
                            ]);

            $respuesta = BD::crear('ObrasSolicitudesAnalisis', $request);

            return $respuesta;
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasSolicitudesAnalisis::findOrFail($id);
        $responsables_intervencion = ObrasUsuariosAsignados::selectRaw('
                                                                        users.id,
                                                                        users.name
                                                                        ')
                                                            ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                                            ->get();
                                                            
        return view('dashboard.obras.detalle.solicitudes-analisis.agregar', ["registro" => $registro, 'responsables_intervencion' => $responsables_intervencion]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasSolicitudesAnalisis", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasSolicitudesAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.solicitudes-analisis.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasSolicitudesAnalisis");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function verMuestras($id)
    {
        $registro = ObrasSolicitudesAnalisis::findOrFail($id);

        return view('dashboard.obras.detalle.solicitudes-analisis.ver-muestras', ['registro' => $registro] );
    }

    public function cargarMuestras(Request $request, $solicitud_analisis_id)
    {
        $registros      =   ObrasSolicitudesAnalisisMuestras::selectRaw('
                                                                            obras__solicitudes_analisis_muestras.id,
                                                                            obras_tipo.nombre,
                                                                            obras_tipo.color_hexadecimal,
                                                                            obras__solicitudes_analisis_muestras.no_muestra,
                                                                            obras__solicitudes_analisis_muestras.nomenclatura,
                                                                            obras__solicitudes_analisis_muestras.informacion_requerida,
                                                                            obras__solicitudes_analisis_muestras.motivo,
                                                                            obras__solicitudes_analisis_muestras.descripcion_muestra,
                                                                            obras__solicitudes_analisis_muestras.ubicacion
                                                                        ')
                                                            ->join('obras__solicitudes_analisis_tipo_analisis as obras_tipo', 'obras_tipo.id','=', 'obras__solicitudes_analisis_muestras.tipo_analisis_id')
                                                            ->where('solicitud_analisis_id', '=', $solicitud_analisis_id)->get();

        return DataTables::of($registros)
                        ->editColumn('nombre', function($registro){
                            $color_nombre = '<span style="color: '.$registro->color_hexadecimal.';"><strong>'.$registro->nombre.'</strong></span>';

                            return $color_nombre;
                        })
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editarMuestra('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Editar muestra '.$registro->no_muestra.'"></i>';
                            $eliminar       =   '<i onclick="eliminarMuestra('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eliminar muestra '.$registro->no_muestra.'"></i>';

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['nombre','acciones'])
                        ->make('true');
    }

    public function crearMuestra(Request $request)
    {
        $registro       =   new ObrasSolicitudesAnalisisMuestras;
        $tipos_analisis = ObrasSolicitudesAnalisisTipoAnalisis::all();

        return view('dashboard.obras.detalle.solicitudes-analisis.agregar-muestra', ["registro" => $registro, 'tipos_analisis' => $tipos_analisis]);
    }

    public function guardarMuestra(Request $request)
    {
        if($request->ajax()){
            $request->merge([
                                "usuario_creo_id"   =>  Auth::id()
                            ]);

            return BD::crear('ObrasSolicitudesAnalisisMuestras', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta guardar muestra"], 500);
    }

    public function editarMuestra(Request $request, $id)
    {
        $registro   =   ObrasSolicitudesAnalisisMuestras::findOrFail($id);
        $tipos_analisis = ObrasSolicitudesAnalisisTipoAnalisis::all();

        return view('dashboard.obras.detalle.solicitudes-analisis.agregar-muestra', ["registro" => $registro, 'tipos_analisis' => $tipos_analisis]);
    }

    public function actualizarMuestra(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasSolicitudesAnalisisMuestras", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarMuestra(Request $request, $id)
    {
        $registro   =   ObrasSolicitudesAnalisisMuestras::findOrFail($id);
        return view('dashboard.obras.detalle.solicitudes-analisis.eliminar-muestra', ["registro" => $registro]);
    }

    public function destruirMuestra(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasSolicitudesAnalisisMuestras");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
