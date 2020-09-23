@extends('layouts.dashboard', ['menu' => "obras"])

@section('top-body')
    <div class="col-sm-12">
        <h2>Detalle de obra <strong>{{ $obra->nombre }}</strong></h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('dashboard.obras.index') }}">Obras</a>
            </li>
            <li class="active">
                <strong>{{ $obra->nombre }}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Información general</h5>
                </div>
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-form-general">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    {!! Form::open(['route' => ['dashboard.obras.update', $obra->id], 'method' => 'PUT', 'id' => 'form-obras', 'class' => 'form-horizontal']) !!}
                        <div class="row">
                            <div class="col-md-6">                                
                                <div class="row">
                                    <div class="col-md-12 div-input">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $obra->nombre }}" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 div-input">
                                        <label for="tipo_bien_cultural_id">Tipo de bien cultural</label>
                                        <select class="form-control select2" id="tipo_bien_cultural_id" name="tipo_bien_cultural_id" required autocomplete="off">
                                            <option value=""></option>
                                            @foreach ($tiposBienCultural as $bienCultural)
                                                <option {{ $bienCultural->id == $obra->tipo_bien_cultural_id ? "selected" : "" }} id="tipo-bien-cultural-{{ $bienCultural->id }}" calcular-temporalidad="{{ $bienCultural->calcular_temporalidad }}" value="{{ $bienCultural->id }}">{{ $bienCultural->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 div-input">
                                        <label for="tipo_objeto_id">Tipo de objeto</label>
                                        <select class="form-control select2" id="tipo_objeto_id" name="tipo_objeto_id" required autocomplete="off">
                                            <option value=""></option>
                                            @foreach ($tiposObjeto as $objeto)
                                                <option {{ $objeto->id == $obra->tipo_objeto_id ? "selected" : "" }} value="{{ $objeto->id }}">{{ $objeto->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Si el tipo de bien cultural es calcular temporalidad entonces se muestra la cultura, si no el autor --}}
                                <div class="row" id="div-cultura">
                                    <div class="col-md-12 div-input">
                                        <label for="cultura">Cultura</label>
                                        <input type="text" class="form-control" id="cultura" name="cultura" value="{{ $obra->cultura }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="row" id="div-autor">
                                    <div class="col-md-12 div-input">
                                        <label for="autor">Autor</label>
                                        <input type="text" class="form-control" id="autor" name="autor" value="{{ $obra->autor }}" required autocomplete="off">
                                    </div>
                                </div>

                                {{-- Si el tipo de bien cultural es calcular temporalidad --}}

                                <div class="row" id="div-temporalidad">
                                    <div class="col-md-12 div-input">
                                        <label for="temporalidad_id">Temporalidad</label>
                                        <select class="form-control select2 full-width" id="temporalidad_id" name="temporalidad_id" required autocomplete="off">
                                            <option value=""></option>
                                            @foreach ($temporalidades as $temporalidad)
                                                <option {{ $obra->temporalidad_id == $temporalidad->id ? "selected" : "" }} value="{{ $temporalidad->id }}">{{ $temporalidad->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Si no --}}

                                <div class="row" id="div-epoca">
                                    <div class="col-md-8 div-input">
                                        <label for="epoca_id">Época</label>
                                        <select class="form-control select2 full-width" name="epoca_id" id="epoca_id" required autocomplete="off">
                                            <option value=""></option>
                                            @foreach ($epocas as $epoca)
                                                <option {{ $obra->epoca_id == $epoca->id ? "selected" : "" }} value="{{ $epoca->id }}">{{ $epoca->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 div-input">
                                        <label for="estatus_epoca">Estatus</label>
                                        <select class="form-control select2 full-width" name="estatus_epoca" id="estatus_epoca">
                                            <option value=""></option>
                                            @foreach (config('valores.status_años_obras') as $status)
                                                <option {{ $obra->estatus_epoca == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Si la epoca es confirmada se muestra el año --}}
                                <div class="row" id="div-año">
                                    <div class="col-md-8 div-input">
                                        <label for="año">Año</label>
                                        <input type="text" class="form-control" id="año" name="año" value="{{ $obra->año ? $obra->año->format('Y') : '' }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-4 div-input">
                                        <label for="estatus_año">Estatus</label>
                                        <select class="form-control select2 full-width" name="estatus_año" id="estatus_año">
                                            <option value=""></option>
                                            @foreach (config('valores.status_años_obras') as $status)
                                                <option {{ $obra->estatus_año == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5 div-input">
                                        <label for="lugar_procedencia_actual">Lugar de procedencia actual</label>
                                        <input type="text" class="form-control" id="lugar_procedencia_actual" name="lugar_procedencia_actual" value="{{ $obra->lugar_procedencia_actual }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-5 div-input">
                                        <label for="lugar_procedencia_original">Lugar de procedencia original</label>
                                        <input type="text" class="form-control" id="lugar_procedencia_original" name="lugar_procedencia_original" value="{{ $obra->lugar_procedencia_original }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-2 div-input">
                                        <label for="numero_inventario">No inventario</label>
                                        <input type="text" class="form-control" id="numero_inventario" name="numero_inventario" value="{{ $obra->numero_inventario }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 div-input">
                                        <label for="alto">Alto</label>
                                        <input type="number" class="form-control" id="alto" name="alto" value="{{ $obra->alto }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-3 div-input">
                                        <label for="largo">Largo</label>
                                        <input type="number" class="form-control" id="largo" name="largo" value="{{ $obra->largo }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-3 div-input">
                                        <label for="ancho">Ancho</label>
                                        <input type="number" class="form-control" id="ancho" name="ancho" value="{{ $obra->ancho }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-3 div-input">
                                        <label for="diametro">Diametro</label>
                                        <input type="number" class="form-control" id="diametro" name="diametro" value="{{ $obra->diametro }}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 div-input">
                                        <label for="caracteristicas_descriptivas">Características descriptivas</label>
                                        <textarea class="form-control no-resize" name="caracteristicas_descriptivas" id="caracteristicas_descriptivas" rows="6">{{ $obra->caracteristicas_descriptivas }}</textarea>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="row">
                                    <div class="col-md-12 div-input">
                                        <label for="area_id">Área</label>
                                        <select class="form-control select2 full-width" id="area_id" name="area_id" required autocomplete="off">
                                            <option value=""></option>
                                            @foreach ($areas as $area)
                                                <option {{ $obra->area_id == $area->id ? "selected" : "" }} value="{{ $area->id }}">{{ $area->campo }} {{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9 div-input">
                                        <label for="_responsables">Responsables ECRO</label>
                                        <select class="form-control select2 full-width" id="_responsables" name="_responsables[]" required autocomplete="off" multiple="">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 div-input">
                                        <label for="forma_ingreso">Forma de ingreso</label>
                                        <select class="form-control select2 full-width" id="forma_ingreso" name="forma_ingreso" required autocomplete="off">
                                            <option value=""></option>
                                            @foreach (config('valores.obras_formas_ingreso') as $forma)
                                                <option {{ $obra->forma_ingreso == $forma ? "selected" : "" }} value="{{ $forma }}">{{ $forma }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 div-input">
                                        <label for="fecha_ingreso">Fecha ingreso</label>
                                        <input type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="{{ $obra->fecha_ingreso }}" required autocomplete="off">
                                    </div>
                                    <div class="col-md-6 div-input">
                                        <label for="fecha_salida">Fecha salida</label>
                                        <input type="text" class="form-control" id="fecha_salida" name="fecha_salida" value="{{ $obra->fecha_salida }}" required autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-fileinput form-group-default text-center">
                                            <span class="fileinput-title">Vista frontal</span>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=sin+imagen" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" id="contenedor_imagen">
                                                </div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Selecciona una imagen</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="avatar" id="avatar" value="" class="" aria-invalid="false">
                                                    </span>
                                      
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Limpiar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-fileinput form-group-default text-center">
                                            <span class="fileinput-title">Vista posterior</span>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=sin+imagen" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" id="contenedor_imagen">
                                                </div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Selecciona una imagen</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="avatar" id="avatar" value="" class="" aria-invalid="false">
                                                    </span>
                                      
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Limpiar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-fileinput form-group-default text-center">
                                            <span class="fileinput-title">Vista lateral derecha</span>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=sin+imagen" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" id="contenedor_imagen">
                                                </div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Selecciona una imagen</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="avatar" id="avatar" value="" class="" aria-invalid="false">
                                                    </span>
                                      
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Limpiar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-fileinput form-group-default text-center">
                                            <span class="fileinput-title">Vista lateral izquierda</span>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=sin+imagen" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" id="contenedor_imagen">
                                                </div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Selecciona una imagen</span>
                                                        <span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="avatar" id="avatar" value="" class="" aria-invalid="false">
                                                    </span>
                                      
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Limpiar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-12 m-b-md">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-solicitudes-analisis"> Solicitudes de ánalisis</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Tab 2</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-solicitudes-analisis" class="tab-pane active">
                        <div class="panel-body">
                            <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                existence in this spot, which was created for the bliss of souls like mine.</p>

                            <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <strong>Donec quam felis</strong>

                            <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                            <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/obras/detalle.js') !!}
@endsection