<div class="modal inmodal" id="modal-crear" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Obra" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras.store'], 'method' => 'POST', 'id' => 'form-obras', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 div-input required">
                                <label for="tipo_bien_cultural_id">Tipo de bien cultural</label>
                                <select class="form-control select2" id="tipo_bien_cultural_id" name="tipo_bien_cultural_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tiposBienCultural as $bienCultural)
                                        <option {{ $bienCultural->id == $registro->tipo_bien_cultural_id ? "selected" : "" }} id="tipo-bien-cultural-{{ $bienCultural->id }}" calcular-temporalidad="{{ $bienCultural->calcular_temporalidad }}" value="{{ $bienCultural->id }}">{{ $bienCultural->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input required">
                                <label for="tipo_objeto_id">Tipo de objeto</label>
                                <select class="form-control select2" id="tipo_objeto_id" name="tipo_objeto_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tiposObjeto as $objeto)
                                        <option {{ $objeto->id == $registro->tipo_objeto_id ? "selected" : "" }} value="{{ $objeto->id }}">{{ $objeto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Si el tipo de bien cultural es calcular temporalidad entonces se muestra la cultura, si no el autor --}}
                        <div class="row {{ $registro == "[]" ? "hidden" : "" }}" id="div-cultura">
                            <div class="col-md-12 div-input required">
                                <label for="cultura">Cultura</label>
                                <input type="text" class="form-control" id="cultura" name="cultura" value="{{ $registro->cultura }}" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row {{ $registro == "[]" ? "hidden" : "" }}" id="div-autor">
                            <div class="col-md-12 div-input required">
                                <label for="autor">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="{{ $registro->autor }}" required autocomplete="off">
                            </div>
                        </div>

                        {{-- Si el tipo de bien cultural es calcular temporalidad --}}

                        <div class="row {{ $registro == "[]" ? "hidden" : "" }}" id="div-temporalidad">
                            <div class="col-md-12 div-input required">
                                <label for="temporalidad_id">Temporalidad</label>
                                <select class="form-control select2 full-width" id="temporalidad_id" name="temporalidad_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($temporalidades as $temporalidad)
                                        <option {{ $registro->temporalidad_id == $temporalidad->id ? "selected" : "" }} value="{{ $temporalidad->id }}">{{ $temporalidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Si no --}}

                        <div class="row {{ $registro == "[]" ? "hidden" : "" }}" id="div-epoca">
                            <div class="col-md-8 div-input required">
                                <label for="epoca_id">Época</label>
                                <select class="form-control select2 full-width" name="epoca_id" id="epoca_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($epocas as $epoca)
                                        <option {{ $registro->epoca_id == $epoca->id ? "selected" : "" }} value="{{ $epoca->id }}">{{ $epoca->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 div-input">
                                <label for="estatus_epoca">Estatus</label>
                                <select class="form-control select2 full-width" name="estatus_epoca" id="estatus_epoca">
                                    <option value=""></option>
                                    @foreach (config('valores.status_años_obras') as $status)
                                        <option {{ $registro->estatus_epoca == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Si la epoca es confirmada se muestra el año --}}
                        <div class="row {{ $registro == "[]" ? "hidden" : "" }}" id="div-año">
                            <div class="col-md-8 div-input required">
                                <label for="año">Año</label>
                                <input type="text" class="form-control" id="año" name="año" value="{{ $registro->año ? $registro->año->format('Y') : '' }}" required autocomplete="off">
                            </div>
                            <div class="col-md-4 div-input">
                                <label for="estatus_año">Estatus</label>
                                <select class="form-control select2 full-width" name="estatus_año" id="estatus_año">
                                    <option value=""></option>
                                    @foreach (config('valores.status_años_obras') as $status)
                                        <option {{ $registro->estatus_año == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 div-input required">
                                <label for="lugar_procedencia_actual">Lugar de procedencia actual</label>
                                <input type="text" class="form-control" id="lugar_procedencia_actual" name="lugar_procedencia_actual" value="{{ $registro->lugar_procedencia_actual }}" required autocomplete="off">
                            </div>
                            <div class="col-md-4 div-input required">
                                <label for="numero_inventario">No inventario</label>
                                <input type="text" class="form-control" id="numero_inventario" name="numero_inventario" value="{{ $registro->numero_inventario }}" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 div-input required">
                                <label for="alto">Alto</label>
                                <input type="number" class="form-control" id="alto" name="alto" value="{{ $registro->alto }}" required autocomplete="off">
                            </div>
                            <div class="col-md-3 div-input">
                                <label for="largo">Largo</label>
                                <input type="number" class="form-control" id="largo" name="largo" value="{{ $registro->largo }}" autocomplete="off">
                            </div>
                            <div class="col-md-3 div-input">
                                <label for="profundidad">Profundidad</label>
                                <input type="number" class="form-control" id="profundidad" name="profundidad" value="{{ $registro->profundidad }}" autocomplete="off">
                            </div>
                            <div class="col-md-3 div-input required">
                                <label for="ancho">Ancho</label>
                                <input type="number" class="form-control" id="ancho" name="ancho" value="{{ $registro->ancho }}" required autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-md" id="div-notificacion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            <input type="hidden" id="calcular-temporalidad" name="calcular-temporalidad">
            {!! Form::close() !!}
        </div>
    </div>
</div>