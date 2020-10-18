<div class="modal inmodal" id="modal-rechazar-solicitud-analisis" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Solicitud de análisis</h4>
                <small class="font-bold">Rechazar solicitud de análisis</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.rechazar-solicitud-analisis', $registro->id], 'method' => 'PUT', 'id' => 'form-solicitud-analisis', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
                    <div class="col-md-12">
            		  <p>¿Estas seguro que deseas rechazar la solicitud de análisis con fecha de intervención <strong>{{ $registro->fecha_intervencion }}</strong>?</p>
                    </div>
            	</div>
                <div class="row">
                    <div class="col-md-12 div-input required">
                        <label for="motivo_de_rechazo">Detalles del rechazo</label>
                        <textarea class="form-control no-resize" name="motivo_de_rechazo" id="motivo_de_rechazo" rows="6" required autocomplete="off">{{ $registro->motivo_de_rechazo }}</textarea>
                    </div>
                </div>

                <div class="row m-t-md" id="div-notificacion-solicitud-analisis">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Rechazar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>