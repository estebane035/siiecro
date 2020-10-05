<div class="modal inmodal" id="modal-eliminar-muestra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Muestras</h4>
                <small class="font-bold">Eliminar Muestra de la Solicitud de Análisis</small>
            </div>
            {!! Form::open(['route' => ['dashboard.solicitudes-analisis.destruir-muestra', $registro->id], 'method' => 'DELETE', 'id' => 'form-obras-detalle-solicitudes-analisis-eliminar-muestra', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas eliminar la Muestra <strong>{{ $registro->no_muestra }}</strong> ?</p>
            	</div>

                <div class="row m-t-md" id="div-notificacion-eliminar-muestra">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>