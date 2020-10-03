<div class="modal inmodal" id="modal-crear-muestra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">{{ $registro == "[]" ? "Agregar " : "Editar " }} Muestra</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva muestra" : "Editando muestra " }} <strong>{{ $registro->no_muestra }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.solicitudes-analisis.guardar-muestra'], 'method' => 'POST', 'id' => 'form-obras-detalle-solicitudes-analisis-crear-muestra', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.solicitudes-analisis.actualizar-muestra', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-detalle-solicitudes-analisis-crear-muestra', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="tipo_analisis_id">Tipo de análisis</label>
                                <select class="form-control select2" id="tipo_analisis_id" name="tipo_analisis_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tipos_analisis as $tipo_analisis)
                                        <option {{ $tipo_analisis->id == $registro->tipo_analisis_id ? "selected" : "" }} value="{{ $tipo_analisis->id }}">{{ $tipo_analisis->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="no_muestra">No. Muestra</label>
                                <input type="text" class="form-control" id="no_muestra" name="no_muestra" value="{{ $registro->no_muestra }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="nomenclatura">Nomenclatura</label>
                                <input type="text" class="form-control" id="nomenclatura" name="nomenclatura" value="{{ $registro->nomenclatura }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="informacion_requerida">Información Requerida</label>
                                <input type="text" class="form-control" id="informacion_requerida" name="informacion_requerida" value="{{ $registro->informacion_requerida }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="motivo">Motivo</label>
                                <input type="text" class="form-control" id="motivo" name="motivo" value="{{ $registro->motivo }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="descripcion_muestra">Descripción de la muestra</label>
                                <input type="text" class="form-control" id="descripcion_muestra" name="descripcion_muestra" value="{{ $registro->descripcion_muestra }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $registro->ubicacion }}" required autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-md" id="div-notificacion-muestra">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                
                <input type="hidden" id="solicitud_analisis_id" name="solicitud_analisis_id" value="">

                {{-- <input type="text" id="solicitud_analisis_id" name="solicitud_analisis_id" value="{{ $registro != "[]" ? $registro->solicitud_analisis_id : ''}}"> --}}
            {!! Form::close() !!}
        </div>
    </div>
</div>