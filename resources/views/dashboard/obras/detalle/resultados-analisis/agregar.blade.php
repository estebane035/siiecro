<div class="modal inmodal" id="modal-crear-resultado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras | Detalle | Resultados de Análisis</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando Resultado de Análisis" : "Editando resultado " }} <strong>{{ $registro->tecnica }}</strong></small>
                <h1>Obra <strong><span id="ventana-resultados-nombre_obra_solicitud"></span></strong> - Folio <strong><span id="ventana-resultados-folio_obra_solicitud"></span></strong></h1>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.resultados-analisis.store'], 'method' => 'POST', 'id' => 'form-obras-detalle-resultados-analisis', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.resultados-analisis.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-detalle-resultados-analisis', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <h1 class="text-center"><strong>Datos de la muestra</strong></h1>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 div-input">
                                <label for="nomenclatura">Nomenclatura</label>
                                <input type="text" class="form-control" id="nomenclatura" value="{{ $solicitud->nomenclatura }}" disabled="">
                            </div>
                            
                            <div class="col-md-8 div-input">
                                <label for="tipo_analisis">Caracterización materiales</label>
                                <input type="text" class="form-control" id="tipo_analisis" value="{{ $solicitud->nombre }}" disabled="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="lugar_resguardo_muestra">Lugar de resguardo de la muestra</label>
                                <input type="text" class="form-control" id="lugar_resguardo_muestra" name="lugar_resguardo_muestra" value="{{ $registro->lugar_resguardo_muestra }}" >
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 div-input required">
                                <label for="fecha_analisis">Fecha del análisis</label>
                                <input type="text" class="form-control" id="fecha_analisis" name="fecha_analisis" value="{{ $registro->fecha_analisis }}" required autocomplete="off">
                            </div>
                            
                            <div class="col-md-8 div-input required">
                                <label for="profesor_responsable_de_analisis_id">Asesor científico responsable</label>
                                <select class="form-control select2" id="profesor_responsable_de_analisis_id" name="profesor_responsable_de_analisis_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($asesor_cientifico_responsable as $profesor)
                                        <option {{ $profesor->id == $registro->profesor_responsable_de_analisis_id ? "selected" : "" }} value="{{ $profesor->id }}">{{ $profesor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 div-input required">
                                <label for="persona_realiza_analisis_id">Persona que realizó el análisis</label>
                                <select class="form-control select2" id="persona_realiza_analisis_id" name="persona_realiza_analisis_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($persona_realiza_analisis as $persona)
                                        <option {{ $persona->id == $registro->persona_realiza_analisis_id ? "selected" : "" }} value="{{ $persona->id }}">{{ $persona->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 div-input required">
                                <label for="forma_obtencion_muestra_id">Forma de obtención de la muestra</label>
                                <select class="form-control select2" id="forma_obtencion_muestra_id" name="forma_obtencion_muestra_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($formas_obtencion as $forma_obtencion)
                                        <option {{ $forma_obtencion->id == $registro->forma_obtencion_muestra_id ? "selected" : "" }} value="{{ $forma_obtencion->id }}">{{ $forma_obtencion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- seccion de captura después de la creación de resultado de la muestra --}}
                    @if ($registro != "[]")
                    <div class="form-group ibox">
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="ubicacion_de_toma_muestra">Ubicación de la toma de muestra</label>
                                <input type="text" class="form-control" id="ubicacion_de_toma_muestra" name="ubicacion_de_toma_muestra" value="{{ $registro->ubicacion_de_toma_muestra }}" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="dropzone-esquema-muestra">Esquema</label>
                                <div class="dropzone" id="dropzone-esquema-muestra">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-md">
                            @include('dashboard.obras.detalle.resultados-analisis.esquema-muestra.ver', ["esquema_muestra" => $registro->imagenes_resultados_esquema_muestra])
                        </div>
                        <hr>
                        <h1 class="text-center"><strong>Características de Observación preliminar (Microscopio estereoscópico)</strong></h1>
                        <div class="row">
                            <div class="col-md-6 div-input required">
                                <label for="tipo_material_id">Tipo de material</label>
                                <select class="form-control select2" id="tipo_material_id" name="tipo_material_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tipos_material as $tipo_material)
                                        <option {{ $tipo_material->id == $registro->tipo_material_id ? "selected" : "" }} value="{{ $tipo_material->id }}">{{ $tipo_material->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 div-input">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $registro->descripcion }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="dropzone-esquema-microfotografia">Microfotografía</label>
                                <div class="dropzone" id="dropzone-esquema-microfotografia">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-md">
                            @include('dashboard.obras.detalle.resultados-analisis.esquema-microfotografia.ver', ["esquema_microfotografia" => $registro->imagenes_resultados_esquema_microfotografia])
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="ruta_acceso_microfotografia">Ruta de acceso a microfotografía</label>
                                <input type="text" class="form-control" id="ruta_acceso_microfotografia" name="ruta_acceso_microfotografia" value="{{ $registro->ruta_acceso_microfotografia }}" autocomplete="off">
                            </div>
                        </div>

                        <hr>
                        <h1 class="text-center"><strong>Datos Analíticos | Resultados</strong></h1>
                        <br>
                        <div class="row ibox">
                            <div class="col-md-6 div-input required">
                                <label for="informacion_por_definir_id">Información por definir</label>
                                <select class="form-control select2" id="informacion_por_definir_id" name="informacion_por_definir_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tipos_material_informacion_por_definir as $informacion_por_definir)
                                        <option {{ $informacion_por_definir->id == $registro->informacion_por_definir_id ? "selected" : "" }} value="{{ $informacion_por_definir->id }}">{{ $informacion_por_definir->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="button" onclick="crearResultadoAnalitico({{ $registro->id }})" class="btn btn-primary pull-right">Agregar resultados analiticos</button>
                            </div>
                        </div>
                        {{-- tabla de datos analiticos --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="progress hidden" id="carga-dt-analisis-realizar-resultados">
                                            <div class="progress-bar-indeterminate"></div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="dt-datos-analisis-realizar-resultados">
                                                <thead>
                                                    <tr>
                                                        <th>Análisis a realizar</th>
                                                        <th>Técnica analítica</th>
                                                        <th>Interpretación</th>
                                                        <th>Foto</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 div-input">
                                <label for="conclusion_general">Conclusion general</label>
                                <textarea class="form-control no-resize" name="conclusion_general" id="conclusion_general" rows="6" autocomplete="off"><?php echo($registro->conclusion_general); ?></textarea>
                            </div>
                            <div class="col-md-6 div-input required">
                                <label for="interpretacion_particular_id">Interpretación particular</label>
                                <select class="form-control select2" id="interpretacion_particular_id" name="interpretacion_particular_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tipos_material_interpretacion_particular as $interpretacion_particular)
                                        <option {{ $interpretacion_particular->id == $registro->interpretacion_particular_id ? "selected" : "" }} value="{{ $interpretacion_particular->id }}">{{ $interpretacion_particular->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    @endif

                    <div class="row m-t-md" id="div-notificacion-resultado">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" onclick="$('#modal-crear-resultado').modal('toggle');$('body').removeClass('modal-open');">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <input type="hidden" id="solicitudes_analisis_muestras_id" name="solicitudes_analisis_muestras_id" value="{{ $registro != "[]" ? $registro->solicitudes_analisis_muestras_id : ''}}">
            {!! Form::close() !!}
        </div>
    </div>
</div>