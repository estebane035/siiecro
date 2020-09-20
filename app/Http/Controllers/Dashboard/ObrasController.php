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

use App\Obras;
use App\ObrasEpoca;
use App\ObrasTemporalidad;
use App\ObrasTipoBienCultural;
use App\ObrasTipoObjeto;

class ObrasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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
                                                oe.nombre as epoca,
                                                ot.nombre as temporalidad,
                                                oto.nombre as tipo_objeto,
                                                'Falta programar' as area
                                            ")
                                    ->leftJoin('obras__temporalidad as ot', 'ot.id', 'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe', 'oe.id', 'obras.epoca_id')
                                    ->leftJoin('obras__tipo_objeto as oto', 'oto.id', 'obras.tipo_objeto_id')
                                    ->orWhereNotNull('fecha_aprobacion');

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
                            $editar         =   '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->id).'"><i class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i></a>';
                            $eliminar   	=   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function cargarSolicitudesIntervencion(){
        $registros      =   Obras::selectRaw("
                                                obras.*,
                                                oe.nombre as epoca,
                                                ot.nombre as temporalidad,
                                                oto.nombre as tipo_objeto
                                            ")
                                    ->leftJoin('obras__temporalidad as ot', 'ot.id', 'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe', 'oe.id', 'obras.epoca_id')
                                    ->leftJoin('obras__tipo_objeto as oto', 'oto.id', 'obras.tipo_objeto_id')
                                    ->whereNull('obras.fecha_aprobacion');

        return DataTables::of($registros)
                        ->editColumn('año', function($registro){
                            if($registro->año){
                                return Carbon::parse($registro->año)->format('Y');
                            }

                            return NULL;
                        })
                        ->addColumn('acciones', function($registro){
                            $eliminar       =   '';
                            $aprobar        =   '';
                            $rechazar       =   '';

                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i>';

                            if($registro->fecha_rechazo){
                                $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"></i>';
                            } else{
                                $aprobar    =   '<i onclick="aprobar('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Aprobar"></i>';
                                $rechazar   =   '<i onclick="rechazar('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" data-toggle="tooltip" data-placement="top" data-original-title="Rechazar"></i>';
                            }

                            return $editar.$aprobar.$rechazar.$eliminar;
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
                                    "temporalidad_id"   =>  NULL,
                                    "año"               =>  $request->input("año")."-01-01"
                                ]);

                // Si el estatus del año es aproximado no debe de tener epoca
                if($request->input('estatus_año') == "Aproximado"){
                    $request->merge([
                                        "epoca_id"          =>  NULL,
                                        "estatus_epoca"     =>  NULL
                                    ]);
                }
            }

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
                                    "temporalidad_id"   =>  NULL,
                                    "año"               =>  $request->input("año")."-01-01"
                                ]);

                // Si el estatus del año es aproximado no debe de tener epoca
                if($request->input('estatus_año') == "Aproximado"){
                    $request->merge([
                                        "epoca_id"          =>  NULL,
                                        "estatus_epoca"     =>  NULL
                                    ]);
                }
            }

            $data               =   $request->all();
            return BD::actualiza($id, "Obras", $data);
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
        $registro               =   Obras::findOrFail($id);
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        $epocas                 =   ObrasEpoca::all();
        $temporalidades         =   ObrasTemporalidad::all();
        return view('dashboard.obras.detalle.detalle', ["obra" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades]);
    }
}