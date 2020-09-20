<div class="modal inmodal" id="modal-aprobar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras</h4>
                <small class="font-bold">Aprobar solicitud de intervención a obra</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.aprobar', $registro->id], 'method' => 'PUT', 'id' => 'form-obras', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas aprobar la solicitud a la obra <strong>{{ $registro->nombre }}</strong>?</p>
            	</div>

                <div class="row m-t-md" id="div-notificacion">
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