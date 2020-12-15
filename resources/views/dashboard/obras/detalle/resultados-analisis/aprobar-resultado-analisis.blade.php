<div class="modal inmodal" id="modal-aprobar-resultado-analisis" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Resultado de análisis</h4>
                <small class="font-bold">Aprobar resultado de análisis</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.aprobar-resultado-analisis', $registro->id], 'method' => 'PUT', 'id' => 'form-resultado-analisis', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
                    <div class="col-md-12">
            		  <p>¿Estas seguro que deseas aprobar el resultado de análisis con fecha <strong>{{ $registro->fecha_analisis }}</strong> ?</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 div-input">
                        <label for="motivo_de_rechazo">Comentarios</label>
                        <textarea class="form-control no-resize" name="motivo_de_rechazo" id="motivo_de_rechazo" rows="6" autocomplete="off" placeholder="Comentarios opcionales"></textarea>
                    </div>
                </div>

                <div class="row m-t-md" id="div-notificacion-resultado-analisis">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Aprobar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>