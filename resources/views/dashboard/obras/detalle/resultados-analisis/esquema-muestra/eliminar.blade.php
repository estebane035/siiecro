<div class="modal inmodal" id="modal-eliminar-imagen-resultado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Imagen</h4>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.eliminar-esquema-muestra-resultados-analisis', $registro->id], 'method' => 'DELETE', 'id' => 'form-eliminar-imagen-resultado', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas eliminar la imagen?</p>
            	</div>

                <div class="row">
                    <div class="col-12">
                        <img class="img-responsive" src="{{ asset('img/obras/resultados-analisis-esquema-muestra/'.$registro->imagen) }}" alt="">
                    </div>
                </div>

                <div class="row m-t-md" id="div-notificacion">
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