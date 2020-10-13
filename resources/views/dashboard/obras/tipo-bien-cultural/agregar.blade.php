<div class="modal inmodal" id="modal-crear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras | Tipo Bien Cultural</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nuevo Tipo Bien Cultural" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras-tipo-bien-cultural.store'], 'method' => 'POST', 'id' => 'form-obras-tipo-bien-cultural', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras-tipo-bien-cultural.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-tipo-bien-cultural', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <div class="i-checks pull-right">
                                    <label class="pointer">
                                         Calcular temporalidad &nbsp;&nbsp; <input type="checkbox" name="calcular_temporalidad"  {{ (($registro->calcular_temporalidad == 'si') ? 'checked=""' : '') }} >
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-md" id="div-notificacion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>