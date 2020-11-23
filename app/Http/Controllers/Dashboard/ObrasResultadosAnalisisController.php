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

use App\ObrasResultadosAnalisis;
use App\ObrasResultadosAnalisisEsquemaMuestra;
use App\ObrasResultadosAnalisisEsquemaMicrofotografia;

use App\ObrasFormaObtencionMuestra;

use App\ObrasTipoMaterial;
use App\ObrasTipoMaterialInformacionPorDefinir;
use App\ObrasTipoMaterialInterpretacionParticular;

use App\ObrasAnalisisARealizarResultados;
use App\ObrasAnalisisARealizar;
use App\ObrasAnalisisARealizarTecnica;
use App\ObrasAnalisisARealizarMicrofotografia;

class ObrasResultadosAnalisisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cargarTabla(Request $request, $obra_id)
    {
        $registros      =   ObrasResultadosAnalisis::selectRaw('
                                                                    obras__resultados_analisis.id,
                                                                    obras__resultados_analisis.fecha_analisis,
                                                                    obras__solicitudes_analisis_tipo_analisis.nombre,
                                                                    obras__solicitudes_analisis_muestras.nomenclatura
                                                                ')
                                                                    // obras__resultados_analisis.descripcion,
                                                    // ->join('users', 'users.id','=', 'obras__solicitudes_analisis.obra_usuario_asignado_id')
                                                    ->join('obras__solicitudes_analisis_muestras', 'obras__solicitudes_analisis_muestras.id','=', 'obras__resultados_analisis.solicitudes_analisis_muestras_id')
                                                    ->join('obras__solicitudes_analisis', 'obras__solicitudes_analisis.id','=', 'obras__solicitudes_analisis_muestras.solicitud_analisis_id')
                                                    ->join('obras__solicitudes_analisis_tipo_analisis', 'obras__solicitudes_analisis_tipo_analisis.id','=', 'obras__solicitudes_analisis_muestras.tipo_analisis_id')
                                                    ->where('obras__solicitudes_analisis.obra_id', '=', $obra_id)
                                                    ->get();

        return DataTables::of($registros)
                        ->editColumn('fecha_analisis', function($registro){
                            $fecha = '<span mi-tooltip="'.$registro->fecha_analisis.'"><strong>'.$registro->fecha_analisis.'</strong></span>';
                            
                            return $fecha;
                        })
                        ->editColumn('imagen', function($registro){
                            $img    = ObrasResultadosAnalisisEsquemaMuestra::where('resultado_analisis_id',$registro->id)->first();
                            $altura = 40;
                            
                            $imagen = '<img src="'.asset('img/predeterminadas/sin_imagen.png').'" height="'.$altura.'">';
                            
                            if ($img != NULL) {
                                $imagen = '<img src="'.asset('img/obras/resultados-analisis-esquema-muestra/'.$img->imagen).'" height="'.$altura.'">';
                            }
                            
                            return $imagen;
                        })
                        ->addColumn('acciones', function($registro){
                            $editar     = '<i onclick="editarResultado('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar resultado de analisis"></i>';
                            // $analiticos = '<i onclick="agregarDatosAnaliticos('.$registro->id.')" class="fa fa-plus fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Agregar datos analíticos"></i>';
                            $eliminar   = '<i onclick="eliminarResultado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar resultado de analisis"></i>';

                            // return $editar.$analiticos.$eliminar;
                            return $editar.$eliminar;
                        })
                        ->rawColumns(['imagen','fecha_analisis','acciones'])
                        ->make('true');
    }

    public function create()
    {
        $registro           = new ObrasResultadosAnalisis;
        $formas_obtencion   = ObrasFormaObtencionMuestra::all();
        // $tipos_material     = ObrasTipoMaterial::all();

        return view('dashboard.obras.detalle.resultados-analisis.agregar', ["registro" => $registro, 'formas_obtencion' => $formas_obtencion]);
        // return view('dashboard.obras.detalle.resultados-analisis.agregar', ["registro" => $registro, 'formas_obtencion' => $formas_obtencion, 'tipos_material' => $tipos_material]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            // $request->merge([
            //                     // "usuario_creo_id"   =>  Auth::id()
            //                 ]);

            return BD::crear('ObrasResultadosAnalisis', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta guardar muestra"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro                                   = ObrasResultadosAnalisis::findOrFail($id);
        $formas_obtencion                           = ObrasFormaObtencionMuestra::all();
        $tipos_material                             = ObrasTipoMaterial::all();
        $tipos_material_informacion_por_definir     = ObrasTipoMaterialInformacionPorDefinir::all();
        $tipos_material_interpretacion_particular   = ObrasTipoMaterialInterpretacionParticular::all();

        // $responsables_intervencion  = ObrasUsuariosAsignados::selectRaw('
        //                                                                 users.id,
        //                                                                 users.name
        //                                                                 ')
        //                                                     ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
        //                                                     ->where('users.es_responsable_intervencion', '=', 'si')
        //                                                     ->where('obras__usuarios_asignados.id', '=', $id)
        //                                                     ->get();
                                                            
        return view('dashboard.obras.detalle.resultados-analisis.agregar', ["registro" => $registro, 'formas_obtencion' => $formas_obtencion, 'tipos_material' => $tipos_material, 'tipos_material_informacion_por_definir' => $tipos_material_informacion_por_definir, 'tipos_material_interpretacion_particular' => $tipos_material_interpretacion_particular]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();

            return BD::actualiza($id, "ObrasResultadosAnalisis", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasResultadosAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasResultadosAnalisis");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### ANALISIS A REALIZAR RESULTADOS ANALÍTICOS ########################################################
    public function cargarAnalisisRealizarResultados(Request $request, $resultado_analisis_id)
    {
        // DB::enableQueryLog();

        $registros  = ObrasAnalisisARealizarResultados::selectRaw('
                                                                    obras__resultados_analisis.id,
                                                                    obras__analisis_a_realizar_resultados.id AS id_resultado,
                                                                    obras__analisis_a_realizar.nombre AS analisis_a_realizar_nombre,
                                                                    obras__analisis_a_realizar_tecnica.nombre AS tecnica_analitica_nombre,
                                                                    obras__analisis_a_realizar_resultados.interpretacion
                                                                ')
                                                    ->join('obras__resultados_analisis',                        'obras__analisis_a_realizar_resultados.resultado_analisis_id',                  '=', 'obras__resultados_analisis.id')
                                                    ->join('obras__analisis_a_realizar',                        'obras__analisis_a_realizar.id',                                                '=', 'obras__analisis_a_realizar_resultados.analisis_a_realizar_id')
                                                    ->join('obras__analisis_a_realizar_tecnica',                'obras__analisis_a_realizar_tecnica.id',                                        '=', 'obras__analisis_a_realizar_resultados.tecnica_analitica_id')
                                                    ->where('obras__analisis_a_realizar_resultados.resultado_analisis_id', '=', $resultado_analisis_id)
                                                    ->get();
                                                    // ->toSql();
        // print_r('<pre>');
        // print_r(DB::getQueryLog());
        // exit;

        return DataTables::of($registros)
                        ->editColumn('imagen', function($registro){
                            $img    = ObrasAnalisisARealizarMicrofotografia::where('analisis_a_realizar_resultado_id',$registro->id_resultado)->first();
                            $altura = 40;

                            $imagen = '<img src="'.asset('img/predeterminadas/sin_imagen.png').'" height="'.$altura.'">';
                            
                            if ($img != NULL) {
                                $imagen = '<img src="'.asset('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$img->imagen).'" height="'.$altura.'">';
                            }
                            
                            return $imagen;
                        })
                        ->addColumn('acciones', function($registro){
                            $editar     = '<i onclick="editarDatosAnaliticos('.$registro->id_resultado.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar resultado de analisis"></i>';
                            // $analiticos = '<i onclick="agregarDatosAnaliticos('.$registro->id.')" class="fa fa-plus fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Agregar datos analíticos"></i>';
                            $eliminar   = '<i onclick="eliminarDatosAnaliticos('.$registro->id_resultado.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar resultado de analisis"></i>';

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['imagen','acciones'])
                        ->make('true');
    }

    public function crearResultadoAnalitico()
    {
        $registro                       = new ObrasAnalisisARealizarResultados;
        $analisis_a_realizar            = ObrasAnalisisARealizar::all();
        $analisis_a_realizar_tecnicas   = ObrasAnalisisARealizarTecnica::all();

        return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.agregar', ['registro' => $registro, 'analisis_a_realizar' => $analisis_a_realizar, 'analisis_a_realizar_tecnicas' => $analisis_a_realizar_tecnicas]);
    }

    public function guardarResultadoAnalitico(Request $request)
    {
        if($request->ajax()){
            // $request->merge([
            //                     // "usuario_creo_id"   =>  Auth::id()
            //                 ]);

            return BD::crear('ObrasAnalisisARealizarResultados', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta guardar resultado analitico"], 500);
    }

    public function editarResultadoAnalitico(Request $request, $id)
    {
        $registro                       = ObrasAnalisisARealizarResultados::findOrFail($id);
        $analisis_a_realizar            = ObrasAnalisisARealizar::all();
        $analisis_a_realizar_tecnicas   = ObrasAnalisisARealizarTecnica::all();

        // $responsables_intervencion  = ObrasUsuariosAsignados::selectRaw('
        //                                                                 users.id,
        //                                                                 users.name
        //                                                                 ')
        //                                                     ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
        //                                                     ->where('users.es_responsable_intervencion', '=', 'si')
        //                                                     ->where('obras__usuarios_asignados.id', '=', $id)
        //                                                     ->get();
                                                            
        return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.agregar', ['registro' => $registro, 'analisis_a_realizar' => $analisis_a_realizar, 'analisis_a_realizar_tecnicas' => $analisis_a_realizar_tecnicas]);
    }

    public function actualizarResultadoAnalitico(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();

            return BD::actualiza($id, "ObrasAnalisisARealizarResultados", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarResultadoAnalitico(Request $request, $id)
    {
        $registro   =   ObrasAnalisisARealizarResultados::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.eliminar', ["registro" => $registro]);
    }

    public function destruirResultadoAnalitico(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasAnalisisARealizarResultados");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #########################################################################################################

    ##### ESQUEMA MUESTRA ##########################################################################
        public function verEsquemaMuestra(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                $registro   = ObrasResultadosAnalisis::findOrFail($resultado_analisis_id);
                return view('dashboard.obras.detalle.resultados-analisis.esquema-muestra.ver', ["esquema_muestra" => $registro->imagenes_resultados_esquema_muestra]);
            }
            
            return "";
        }

        public function subirImagenEsquemaMuestra(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                          =   new ObrasResultadosAnalisisEsquemaMuestra;
                $imagenEsquema->resultado_analisis_id   =   $resultado_analisis_id;
                $imagenEsquema->imagen                  =   "temp";
                $imagenEsquema->save();

                $extension                              =   $request->file('file')->extension();
                $nombre                                 =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/resultados-analisis-esquema-muestra/", 600) == ""){
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

        public function alertaEliminarEsquemaMuestra(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasResultadosAnalisisEsquemaMuestra::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.resultados-analisis.esquema-muestra.eliminar', ["registro" => $imagen]);
        }

        public function eliminarEsquemaMuestra(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasResultadosAnalisisEsquemaMuestra::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasResultadosAnalisisEsquemaMuestra");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/resultados-analisis-esquema-muestra/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################

    ##### ESQUEMA MICROFOTOGRAFÍA ##################################################################
        public function verEsquemaMicrofotografia(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                $registro   = ObrasResultadosAnalisis::findOrFail($resultado_analisis_id);
                return view('dashboard.obras.detalle.resultados-analisis.esquema-microfotografia.ver', ["esquema_microfotografia" => $registro->imagenes_resultados_esquema_microfotografia]);
            }
            
            return "";
        }

        public function subirImagenEsquemaMicrofotografia(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                          =   new ObrasResultadosAnalisisEsquemaMicrofotografia;
                $imagenEsquema->resultado_analisis_id   =   $resultado_analisis_id;
                $imagenEsquema->imagen                  =   "temp";
                $imagenEsquema->save();

                $extension                              =   $request->file('file')->extension();
                $nombre                                 =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/resultados-analisis-esquema-microfotografia/", 600) == ""){
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

        public function alertaEliminarEsquemaMicrofotografia(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasResultadosAnalisisEsquemaMicrofotografia::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.resultados-analisis.esquema-microfotografia.eliminar', ["registro" => $imagen]);
        }

        public function eliminarEsquemaMicrofotografia(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasResultadosAnalisisEsquemaMicrofotografia::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasResultadosAnalisisEsquemaMicrofotografia");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/resultados-analisis-esquema-microfotografia/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################
    
    ##### ESQUEMA DATOS ANALÍTICOS MICROFOTOGRAFÍA ##########################################################
        public function verEsquemaAnaliticosMicrofotografia(Request $request, $analisis_a_realizar_resultado_id){
            if($request->ajax()){
                $registro   = ObrasAnalisisARealizarResultados::findOrFail($analisis_a_realizar_resultado_id);
                return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.esquema-analiticos-microfotografia.ver', ["imagenes_esquema_analiticos_microfotografia" => $registro->esquema_analiticos_microfotografias]);
            }
            
            return "";
        }

        public function subirImagenEsquemaAnaliticosMicrofotografia(Request $request, $analisis_a_realizar_resultado_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                                      =   new ObrasAnalisisARealizarMicrofotografia;
                $imagenEsquema->analisis_a_realizar_resultado_id    =   $analisis_a_realizar_resultado_id;
                $imagenEsquema->imagen                              =   "temp";
                $imagenEsquema->save();

                $extension                                          =   $request->file('file')->extension();
                $nombre                                             =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/resultados-analisis-esquema-analiticos-microfotografia/", 600) == ""){
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

        public function alertaEliminarEsquemaAnaliticosMicrofotografia(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasAnalisisARealizarMicrofotografia::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.esquema-analiticos-microfotografia.eliminar', ["registro" => $imagen]);
        }

        public function eliminarEsquemaAnaliticosMicrofotografia(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasAnalisisARealizarMicrofotografia::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasAnalisisARealizarMicrofotografia");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################
}
