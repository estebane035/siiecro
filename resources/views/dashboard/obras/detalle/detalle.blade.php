@extends('layouts.dashboard')

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
                                        <option {{ $bienCultural->id == $obra->id ? "selected" : "" }} id="tipo-bien-cultural-{{ $bienCultural->id }}" calcular-temporalidad="{{ $bienCultural->calcular_temporalidad }}" value="{{ $bienCultural->id }}">{{ $bienCultural->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="tipo_objeto_id">Tipo de objeto</label>
                                <select class="form-control select2" id="tipo_objeto_id" name="tipo_objeto_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tiposObjeto as $objeto)
                                        <option {{ $objeto->id == $obra->id ? "selected" : "" }} value="{{ $objeto->id }}">{{ $objeto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Si el tipo de bien cultural es calcular temporalidad entonces se muestra la cultura, si no el autor --}}
                        <div class="row {{ $obra == "[]" ? "hidden" : "" }}" id="div-cultura">
                            <div class="col-md-12 div-input">
                                <label for="cultura">Cultura</label>
                                <input type="text" class="form-control" id="cultura" name="cultura" value="{{ $obra->cultura }}" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row {{ $obra == "[]" ? "hidden" : "" }}" id="div-autor">
                            <div class="col-md-12 div-input">
                                <label for="autor">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="{{ $obra->autor }}" required autocomplete="off">
                            </div>
                        </div>

                        {{-- Si el tipo de bien cultural es calcular temporalidad --}}

                        <div class="row {{ $obra == "[]" ? "hidden" : "" }}" id="div-temporalidad">
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

                        <div class="row {{ $obra == "[]" ? "hidden" : "" }}" id="div-año">
                            <div class="col-md-8 div-input">
                                <label for="año">Año</label>
                                <input type="text" class="form-control" id="año" name="año" value="{{ $obra->año }}" required autocomplete="off">
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

                        {{-- Si el año es confirmado se muestra la epoca --}}
                        <div class="row {{ $obra == "[]" ? "hidden" : "" }}" id="div-epoca">
                            <div class="col-md-8 div-input">
                                <label for="epoca_id">Época</label>
                                <select class="form-control select2 full-width" name="epoca_id" id="epoca_id">
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

                        <div class="row">
                            <div class="col-md-8 div-input">
                                <label for="lugar_procedencia_actual">Lugar de procedencia actual</label>
                                <input type="text" class="form-control" id="lugar_procedencia_actual" name="lugar_procedencia_actual" value="{{ $obra->lugar_procedencia_actual }}" required autocomplete="off">
                            </div>
                            <div class="col-md-4 div-input">
                                <label for="numero_inventario">No inventario</label>
                                <input type="text" class="form-control" id="numero_inventario" name="numero_inventario" value="{{ $obra->numero_inventario }}" required autocomplete="off">
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Solicitudes de ánalisis</h5>
                </div>
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-solicitudes-analisis">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Imagenes</h5>
                </div>
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-imagenes">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/obras/obras.js') !!}
@endsection