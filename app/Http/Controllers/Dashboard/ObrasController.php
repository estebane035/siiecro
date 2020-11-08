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

use App\Areas;
use App\Obras;
use App\ObrasEpoca;
use App\ObrasResponsablesAsignados;
use App\ObrasTemporalidad;
use App\ObrasTemporadasTrabajoAsignadas;
use App\ObrasTipoBienCultural;
use App\ObrasTipoObjeto;
use App\User;

class ObrasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:administrar_solicitudes_obras',     [
                                                                                    "only" => [
                                                                                                    "modalAprobar", 
                                                                                                    "aprobar", 
                                                                                                    "modalRechazar", 
                                                                                                    "rechazar"
                                                                                                ]
                                                                                ]);
    }
    
    public function index(){
    	$titulo 		= 	"Obras";
    	
    	return view("dashboard.obras.index", ["titulo" => $titulo]);
    }

    public function solicitudesIntervencion(){
        $titulo         =   "Solicitudes de intervención";
        
        return view("dashboard.obras.solicitudes-intervencion", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	Obras::selectRaw("
                                                obras.*,
                                                obc.nombre  as tipo_bien_cultural,
                                                oe.nombre   as epoca,
                                                ot.nombre   as temporalidad,
                                                oto.nombre  as tipo_objeto,
                                                a.nombre    as nombre_area
                                            ")
                                    ->join('obras__tipo_bien_cultural as obc',  'obc.id',   'obras.tipo_bien_cultural_id')
                                    ->join('obras__tipo_objeto as oto',         'oto.id',   'obras.tipo_objeto_id')
                                    ->leftJoin('obras__temporalidad as ot',     'ot.id',    'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe',            'oe.id',    'obras.epoca_id')
                                    ->leftJoin('areas as a',                    'a.id',     'obras.area_id')
                                    ->whereNotNull('fecha_aprobacion')
                                    ->groupBy('obras.id');

        // Verifico permiso
        if(!Auth::user()->rol->acceso_a_lista_solicitudes_obras){

            $registros  =   $registros->leftJoin('obras__usuarios_asignados as oua',        'oua.obra_id',  'obras.id')
                                        ->leftJoin('obras__responsables_asignados as ora',  'ora.obra_id',  'obras.id')
                                        ->where(function($query){
                                            $query->orWhere('obras.area_id', Auth::user()->area_id ?? 0);
                                            $query->orWhere('oua.usuario_id', Auth::id());
                                            $query->orWhere('ora.usuario_id', Auth::id());
                                        });
        }

    	return DataTables::of($registros)
    					->addColumn('folio', function($registro){
    						return $registro->folio;
    					})
                        ->editColumn('año', function($registro){
                            if($registro->año){
                                return Carbon::parse($registro->año)->format('Y');
                            }

                            return NULL;
                        })
    					->addColumn('acciones', function($registro){
                            $editar         =   '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->id).'"><i class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i></a>';
                            $eliminar   	=   '';

                            if(Auth::user()->rol->eliminar_registro){
                                $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                            }

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function cargarSolicitudesIntervencion(){
        $registros      =   Obras::selectRaw("
                                                obras.*,
                                                obc.nombre as tipo_bien_cultural,
                                                oe.nombre as epoca,
                                                ot.nombre as temporalidad,
                                                oto.nombre as tipo_objeto
                                            ")
                                    ->join('obras__tipo_bien_cultural as obc', 'obc.id', 'obras.tipo_bien_cultural_id')
                                    ->join('obras__tipo_objeto as oto', 'oto.id', 'obras.tipo_objeto_id')
                                    ->leftJoin('obras__temporalidad as ot', 'ot.id', 'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe', 'oe.id', 'obras.epoca_id')
                                    ->whereNull('obras.fecha_aprobacion');

        // Verifico permiso
        if(!Auth::user()->rol->acceso_a_lista_solicitudes_analisis){
            $registros  =   $registros->where("obras.usuario_solicito_id", Auth::id());
        }

        return DataTables::of($registros)
                        ->editColumn('año', function($registro){
                            if($registro->año){
                                return $registro->año->format('Y');
                            }

                            return NULL;
                        })
                        ->addColumn('acciones', function($registro){
                            $eliminar           =   '';
                            $aprobar            =   '';
                            $rechazar           =   '';
                            $editar             =   '';

                            if($registro->fecha_rechazo){
                                if(Auth::user()->rol->eliminar_solicitud_obra){
                                    $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                                }
                            } else{
                                $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';

                                if(Auth::user()->rol->administrar_solicitudes_obras){
                                    $aprobar    =   '<i onclick="aprobar('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Aprobar"></i>';
                                    $rechazar   =   '<i onclick="rechazar('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Rechazar"></i>';
                                }
                            }

                            if(Auth::user()->rol->captura_solicitud_obra){
                                return $editar.$aprobar.$rechazar.$eliminar;
                            } else{
                                return "";
                            }
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request){
        $registro               =   new Obras;
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        $epocas                 =   ObrasEpoca::all();
        $temporalidades         =   ObrasTemporalidad::all();
        return view('dashboard.obras.agregar', ["registro" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades]);
    }

    public function store(Request $request){
        if($request->ajax()){

            // Si calcular temporalidad es si entonces ponemos null los campos de autor, año y epoca
            // Si no entonces ponemos null los campos de cultura y temporalidad
            if($request->input('calcular-temporalidad') == "si"){
                $request->merge([
                                    "autor"             =>  NULL,
                                    "año"               =>  NULL,
                                    "estatus_año"       =>  NULL,
                                    "epoca"             =>  NULL, 
                                    "estatus_epoca"     =>  NULL
                                ]);
            } else{
                $request->merge([
                                    "cultura"           =>  NULL,
                                    "temporalidad_id"   =>  NULL
                                ]);

                // Si el estatus de la epoca es aproximado no debe de tener año
                if($request->input('estatus_epoca') == "Aproximado"){
                    $request->merge([
                                        "año"           =>  NULL,
                                        "estatus_año"   =>  NULL
                                    ]);
                } else{
                    $request->merge([
                                        "año"           =>  $request->input("año")."-01-01"
                                    ]);
                }
            }

            $request->merge([
                                "usuario_solicito_id"   =>  Auth::id()
                            ]);

            return BD::crear('Obras', $request);
        }
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro               =   Obras::findOrFail($id);
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $epocas                 =   ObrasEpoca::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        $temporalidades         =   ObrasTemporalidad::all();
        return view('dashboard.obras.agregar', ["registro" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){

            // Si calcular temporalidad es si entonces ponemos null los campos de autor, año y epoca
            // Si no entonces ponemos null los campos de cultura y temporalidad
            if($request->input('calcular-temporalidad') == "si"){
                $request->merge([
                                    "autor"             =>  NULL,
                                    "año"               =>  NULL,
                                    "estatus_año"       =>  NULL,
                                    "epoca"             =>  NULL, 
                                    "estatus_epoca"     =>  NULL
                                ]);
            } else{
                $request->merge([
                                    "cultura"           =>  NULL,
                                    "temporalidad_id"   =>  NULL
                                ]);

                // Si el estatus de la epoca es aproximado no debe de tener año
                if($request->input('estatus_epoca') == "Aproximado"){
                    $request->merge([
                                        "año"           =>  NULL,
                                        "estatus_año"   =>  NULL
                                    ]);
                } else{
                    $request->merge([
                                        "año"           =>  $request->input("año")."-01-01"
                                    ]);
                }
            }

            $request->merge([
                                "usuario_solicito_id"   =>  Auth::id()
                            ]);
            $data               =   $request->all();
            $respuesta          =   BD::actualiza($id, "Obras", $data);

            // Si se guardo bien entonces guardamos los responsables ECRO
            if(!$respuesta->getData()->error){
                $obra           =   Obras::find($id);

                // Re asignamos los responsables ECRO a la obra
                ObrasResponsablesAsignados::reAsignarResponsables($id, $request->input('_responsables'));

                // Re asignamos las epocas de trabajo recibidas
                ObrasTemporadasTrabajoAsignadas::reAsignarTemporadas($id, $request->input('_temporadas_trabajo'));

                if($request->file('vista_frontal')){
                    $obra->subirImagenVistaFrontal($request->file('vista_frontal'));
                }

                if($request->file('vista_posterior')){
                    $obra->subirImagenVistaPosterior($request->file('vista_posterior'));
                }

                if($request->file('vista_lateral_izquierda')){
                    $obra->subirImagenVistaLateralIzquierda($request->file('vista_lateral_izquierda'));
                }

                if($request->file('vista_lateral_derecha')){
                    $obra->subirImagenVistaLateralDerecha($request->file('vista_lateral_derecha'));
                }

            }

            return $respuesta;
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }


    public function modalAprobar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.aprobar', ["registro" => $registro]);
    }

    public function aprobar(Request $request, $id){
        if($request->ajax()){
            $obra                       =   Obras::findOrFail($id);

            $obra->fecha_aprobacion     =   Carbon::now();
            $obra->save();

            return Response::json(["mensaje" => "Solicitud aprobada exitosamente.", "id" => $obra->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalRechazar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.rechazar', ["registro" => $registro]);
    }

    public function rechazar(Request $request, $id){
        if($request->ajax()){
            $obra                       =   Obras::findOrFail($id);

            $obra->fecha_rechazo        =   Carbon::now();
            $obra->save();

            return Response::json(["mensaje" => "Solicitud rechazada exitosamente.", "id" => $obra->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "Obras");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function show(Request $request, $id){
        $registro                       =   Obras::buscarObraValidandoPermisos($id);
        if(is_null($registro)){
            abort(404);
        }

        $tiposBienCultural              =   ObrasTipoBienCultural::all();
        $tiposObjeto                    =   ObrasTipoObjeto::all();
        $epocas                         =   ObrasEpoca::all();
        $temporalidades                 =   ObrasTemporalidad::all();
        $areas                          =   Areas::all();
        $usuariosPuedenRecibirObras     =   User::where('puede_recibir_obras', 'si')->get();
        $responsablesEcro               =   User::where('es_responsable_ecro', 'si')->get();
        $titulo                         =   $registro->folio;
        return view('dashboard.obras.detalle.detalle', ["titulo" => $titulo, "obra" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades, "areas" => $areas, "usuariosPuedenRecibirObras" => $usuariosPuedenRecibirObras, "responsablesEcro" => $responsablesEcro]);
    }
}
