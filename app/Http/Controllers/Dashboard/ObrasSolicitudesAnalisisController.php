<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;
use Archivos;
use DB;

use App\ObrasSolicitudesAnalisis;
use App\ObrasSolicitudesAnalisisMuestras;
use App\ObrasSolicitudesAnalisisTipoAnalisis;
use App\ObrasSolicitudesAnalisisImagenesEsquema;
use App\ObrasUsuariosAsignados;
// use App\User;

class ObrasSolicitudesAnalisisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
###### SOLICITUDES ANALISIS ##################################################################################
    public function cargarTabla(Request $request, $obra_id)
    {
        $registros      =   ObrasSolicitudesAnalisis::selectRaw('
                                                                    obras__solicitudes_analisis.id,
                                                                    obras__solicitudes_analisis.tecnica,
                                                                    obras__solicitudes_analisis.fecha_intervencion,
                                                                    obras__solicitudes_analisis.estatus,
                                                                    obras__solicitudes_analisis.motivo_de_rechazo,
                                                                    users.name
                                                                ')
                                                    ->join('users', 'users.id','=', 'obras__solicitudes_analisis.obra_usuario_asignado_id')
                                                    ->where('obras__solicitudes_analisis.obra_id', '=', $obra_id)
                                                    ->get();

        return DataTables::of($registros)
                        ->editColumn('fecha_intervencion', function($registro){
                            $label_estatus  = '';
                            $fecha          = '';

                            switch ($registro->estatus) {
                                case 'En revision':{
                                    $label_estatus = 'badge badge-warning';
                                    break;
                                }
                                case 'Aprobada':{
                                    $label_estatus = 'badge badge-primary';
                                    break;
                                }
                                case 'Rechazada':{
                                    $label_estatus = 'badge badge-danger';
                                    break;
                                }
                            }

                            return $fecha = '<span class="'.$label_estatus.'" mi-tooltip="'.$registro->estatus.' - '.$registro->motivo_de_rechazo.'"><strong>'.$registro->fecha_intervencion.'</strong></span>';
                        })
                        ->addColumn('acciones', function($registro){
                            $muestra        = '';
                            $editar         = '';
                            $eliminar       = '';
                            $aprobar        = '';
                            $rechazar       = '';
                            $revision       = '';

                            if ($registro->estatus == 'Rechazada') {
                                $muestra    = '<i onclick="verMuestras('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Ver todas las muestras"></i>';
                                // $editar     = '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar solicitud de analisis"></i>';
                                $eliminar   = '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar solicitud de analisis"></i>';
                                $revision   = '<i onclick="ponerEnRevisionSolicitudAnalisis('.$registro->id.')" class="fa fa-history fa-lg m-r-sm pointer inline-block disabled" aria-hidden="true" mi-tooltip="Poner en revision solicitud de analisis"></i>';
                            }
                            elseif ($registro->estatus == 'Aprobada') {
                                $muestra    = '<i onclick="verMuestras('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Ver todas las muestras"></i>';
                                $editar     = '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar solicitud de analisis"></i>';
                                $eliminar   = '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar solicitud de analisis"></i>';
                                // $aprobar    = '<i onclick="aprobarSolicitudAnalisis('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block disabled" aria-hidden="true" mi-tooltip="Aprobar solicitud de analisis"></i>';
                                $rechazar   = '<i onclick="rechazarSolicitudAnalisis('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Rechazar solicitud de analisis"></i>';
                            }
                            else{
                                $muestra    = '<i onclick="verMuestras('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Ver todas las muestras"></i>';
                                $editar     = '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar solicitud de analisis"></i>';
                                $eliminar   = '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar solicitud de analisis"></i>';
                                $aprobar    = '<i onclick="aprobarSolicitudAnalisis('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Aprobar solicitud de analisis"></i>';
                                $rechazar   = '<i onclick="rechazarSolicitudAnalisis('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Rechazar solicitud de analisis"></i>';
                                // $revision   = '<i onclick="ponerEnRevisionSolicitudAnalisis('.$registro->id.')" class="fa fa-history fa-lg m-r-sm pointer inline-block disabled" aria-hidden="true" mi-tooltip="Poner en revision solicitud de analisis"></i>';
                            }

                            return $muestra.$aprobar.$rechazar.$revision.$editar.$eliminar;
                        })
                        ->rawColumns(['fecha_intervencion','acciones'])
                        ->make('true');
    }

    public function create(Request $request, $id)
    {
        $registro                   = new ObrasSolicitudesAnalisis;
        
        $responsables_intervencion  = ObrasUsuariosAsignados::selectRaw('
                                                                        users.id,
                                                                        users.name
                                                                        ')
                                                            ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                                            ->where('users.es_responsable_intervencion', '=', 'si')
                                                            ->where('obras__usuarios_asignados.obra_id', '=', $id)
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
        $registro                   = ObrasSolicitudesAnalisis::findOrFail($id);
        $responsables_intervencion  = ObrasUsuariosAsignados::selectRaw('
                                                                        users.id,
                                                                        users.name
                                                                        ')
                                                            ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                                            ->where('users.es_responsable_intervencion', '=', 'si')
                                                            ->where('obras__usuarios_asignados.id', '=', $id)
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

    public function modalAprobarSolicitudAnalisis(Request $request, $id){
        $registro   = ObrasSolicitudesAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.solicitudes-analisis.aprobar-solicitud-analisis', ["registro" => $registro]);
    }

    public function aprobarSolicitudAnalisis(Request $request, $id){
        if($request->ajax()){
            $solicitud_analisis                     = ObrasSolicitudesAnalisis::findOrFail($id);

            $solicitud_analisis->usuario_aprobo_id  = Auth::id();
            $solicitud_analisis->estatus            = 'Aprobada';
            $solicitud_analisis->motivo_de_rechazo  = $request->motivo_de_rechazo;
            $solicitud_analisis->fecha_aprobacion   = Carbon::now();
            $solicitud_analisis->save();

            return Response::json(["mensaje" => "Solicitud aprobada exitosamente.", "id" => $solicitud_analisis->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalRechazarSolicitudAnalisis(Request $request, $id){
        $registro   = ObrasSolicitudesAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.solicitudes-analisis.rechazar-solicitud-analisis', ["registro" => $registro]);
    }

    public function rechazarSolicitudAnalisis(Request $request, $id){
        if($request->ajax()){
            $solicitud_analisis                     = ObrasSolicitudesAnalisis::findOrFail($id);

            $solicitud_analisis->usuario_rechazo_id = Auth::id();
            $solicitud_analisis->estatus            = 'Rechazada';
            $solicitud_analisis->motivo_de_rechazo  = $request->motivo_de_rechazo;
            $solicitud_analisis->fecha_rechazo      = Carbon::now();
            $solicitud_analisis->save();

            return Response::json(["mensaje" => "Solicitud rechazada exitosamente.", "id" => $solicitud_analisis->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalEnRevisionSolicitudAnalisis(Request $request, $id){
        $registro   = ObrasSolicitudesAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.solicitudes-analisis.poner-en-revision-solicitud-analisis', ["registro" => $registro]);
    }

    public function enRevisionSolicitudAnalisis(Request $request, $id){
        if($request->ajax()){
            $solicitud_analisis                     = ObrasSolicitudesAnalisis::findOrFail($id);

            $solicitud_analisis->usuario_reviso_id  = Auth::id();
            $solicitud_analisis->estatus            = 'En revision';
            $solicitud_analisis->fecha_revision     = Carbon::now();
            $solicitud_analisis->save();

            return Response::json(["mensaje" => "Solicitud puesta en revisión exitosamente.", "id" => $solicitud_analisis->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### ESQUEMA ###########################################################################################

        public function verEsquema(Request $request, $solicitud_analisis_id){
            if($request->ajax()){
                $registro   =   ObrasSolicitudesAnalisis::findOrFail($solicitud_analisis_id);
                return view('dashboard.obras.detalle.solicitudes-analisis.esquema.ver', ["imagenes_esquema" => $registro->imagenes_esquema]);
            }
            
            return "";
        }

        public function subirImagenEsquema(Request $request, $solicitud_analisis_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                          =   new ObrasSolicitudesAnalisisImagenesEsquema;
                $imagenEsquema->solicitud_analisis_id   =   $solicitud_analisis_id;
                $imagenEsquema->imagen                  =   "temp";
                $imagenEsquema->save();

                $extension                              =   $request->file('file')->extension();
                $nombre                                 =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/solicitudes-analisis-esquema/", 600) == ""){
                    $imagenEsquema->imagen              =   $nombre;
                    $imagenEsquema->save();

                    DB::commit();
                    return Response::json(["mensaje" => "Imagen subida correctamente", "id" => $imagenEsquema->id, "error" => false], 200);
                }else{
                    DB::rollback();
                    return Response::json(["mensaje" => "Error subiendo imagen"], 500);
                }
            }

            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }

        public function alertaEliminarEsquema(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasSolicitudesAnalisisImagenesEsquema::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.solicitudes-analisis.esquema.eliminar', ["registro" => $imagen]);
        }

        public function eliminaresquema(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasSolicitudesAnalisisImagenesEsquema::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasSolicitudesAnalisisImagenesEsquema");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/solicitudes-analisis-esquema/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################
##############################################################################################################

###### MUESTRAS DE LAS SOLICITUDES ANALISIS ##################################################################

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
                            $color_nombre = '<span class="small" style="color: '.$registro->color_hexadecimal.';"><strong>'.$registro->nombre.'</strong></span>';

                            return $color_nombre;
                        })
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editarMuestra('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar muestra '.$registro->no_muestra.'"></i>';
                            $eliminar       =   '<i onclick="eliminarMuestra('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar muestra '.$registro->no_muestra.'"></i>';

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
##############################################################################################################

}
