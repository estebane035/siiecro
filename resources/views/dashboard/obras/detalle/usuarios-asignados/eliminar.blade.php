<div class="modal inmodal" id="modal-eliminar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Desasignar usuario</h4>
            </div>
            {!! Form::open(['route' => ['dashboard.usuarios-asignados.destroy', $registro->id], 'method' => 'DELETE', 'id' => 'form-obras-eliminar-usuario-asignado', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas desasignar a  <strong>{{ $registro->usuario->name }}</strong> de la obra?</p>
            	</div>

                <div class="row m-t-md" id="div-notificacion">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Confirmar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>