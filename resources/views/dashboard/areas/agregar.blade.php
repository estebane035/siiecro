<div class="modal inmodal" id="modal-crear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Áreas</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Área" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.areas.store'], 'method' => 'POST', 'id' => 'form-areas', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.areas.update', $registro->id], 'method' => 'PUT', 'id' => 'form-areas', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="campo">Campo</label>
                                <select class="form-control select2" name="campo" id="campo" autocomplete="off">
                                    <option value="">N/A</option>
                                    @foreach (config('valores.campos_areas') as $campo)
                                        <option {{ $registro->campo == $campo ? "selected" : "" }} value="{{ $campo }}">{{ $campo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="siglas">Siglas</label>
                                <input type="text" class="form-control" id="siglas" name="siglas" value="{{ $registro->siglas }}" required autocomplete="off">
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