<div class="modal inmodal" id="modal-ver-muestras" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 1000px;">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <i onclick="crearMuestra({{ $solicitud_analisis_id }})" class="fa fa-plus fa-lg pointer pull-left" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Crear nueva muestra"></i>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Muestras de la solicitud de análisis</h4>
            </div>
            <div class="modal-body">
                <div class="progress hidden" id="carga-dt-solicitudes-analisis-muestras">
                    <div class="progress-bar-indeterminate"></div>
                </div>
                <table class="table table-striped table-responsive table-condensed" id="dt-datos-solicitudes-analisis-muestras">
                    <thead>
                        <tr>
                            <th>Tipo</th>
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

                <div class="row m-t-md" id="div-notificacion">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id_de_solicitud" value="{{ $solicitud_analisis_id != "[]" ? $solicitud_analisis_id : ''}}">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>