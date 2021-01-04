<div class="modal inmodal" id="modal-ver-muestras" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" {{-- style="width: 1000px;" --}}>
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Solicitud de análisis</h4>

                <h1>Obra <strong><span id="nombre_obra_solicitud"></span></strong> - Folio <strong><span id="folio_obra_solicitud"></span></strong></h1>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 div-input">
                            <label for="tecnica">Técnica</label>
                            <input type="text" class="form-control" id="tecnica" value="{{ $registro->tecnica }}" disabled="" autocomplete="off">
                        </div>
                        <div class="col-md-4 div-input">
                            <label for="fecha_intervencion">Fecha de intervención</label>
                            <input type="text" class="form-control" id="fecha_intervencion" value="{{ $registro->fecha_intervencion }}" disabled="" autocomplete="off">
                        </div>
                        <div class="col-md-4 div-input">
                            <label for="obra_usuario_asignado_id">Responsable</label>
                            <input type="text" class="form-control" id="obra_usuario_asignado_id" value="{{ $registro->reponsable_solicitud->usuario->name }}" disabled="" autocomplete="off">
                        </div>
                    </div>
                    @if ($registro->imagenes_esquema == "[]")
                        <div class="row m-t-md text-center">
                            <h3>Sin esquema</h3>
                            <small>Si lo requiere, vaya al botón edición de la solicitud de análisis para agregar</small>
                        </div>
                    @else
                        <div class="row m-t-md">
                            @include('dashboard.obras.detalle.solicitudes-analisis.esquema.ver', ["imagenes_esquema" => $registro->imagenes_esquema])
                        </div>
                    @endif
                </div>

                <div class="progress hidden" id="carga-dt-solicitudes-analisis-muestras">
                    <div class="progress-bar-indeterminate"></div>
                </div>

                <div class="row ibox">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" onclick="crearMuestra({{ $registro->id }})" class="btn btn-primary pull-right">Agregar muestra</button>
                        </div>                        
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-condensed" id="dt-datos-solicitudes-analisis-muestras">
                        <thead>
                            <tr>
                                <th>Caracterización materiales</th>
                                <th>No Muestra</th>
                                <th>Nomenclatura</th>
                                <th>Información Requerida</th>
                                <th>Motivo</th>
                                <th>Descripción de la Muestra</th>
                                <th>Ubicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="row m-t-md" id="div-notificacion">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id_de_solicitud" value="{{ $registro->id != "[]" ? $registro->id : ''}}">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>