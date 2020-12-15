<div class="modal inmodal" id="modal-poner-en-revision-resultado-analisis" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Resultado de análisis</h4>
                <small class="font-bold">Poner en revision el resultado de análisis</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.poner-en-revision-resultado-analisis', $registro->id], 'method' => 'PUT', 'id' => 'form-resultado-analisis', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas poner en revision el resultado de análisis con fecha <strong>{{ $registro->fecha_analisis }}</strong> ?</p>
            	</div>

                <div class="row m-t-md" id="div-notificacion-resultado-analisis">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-warning">Poner en revisión</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>