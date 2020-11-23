<div class="modal inmodal" id="modal-crear" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Temporada de trabajo</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva temporada de trabajo" : "Editando temporada de trabajo de " }} <strong>{{ $registro->año }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.temporadas-trabajo.store'], 'method' => 'POST', 'id' => 'form-temporadas-trabajo', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.temporadas-trabajo.update', $registro->id], 'method' => 'PUT', 'id' => 'form-temporadas-trabajo', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 div-input required">
                                <label for="nombre">Año</label>
                                <input type="text" class="form-control" id="año" name="año" value="{{ $registro->año }}" required autocomplete="off">
                            </div>
                            <div class="col-md-7 div-input required">
                                <label for="nombre">Número de temporada</label>
                                <select class="form-control select2 full-width" id="numero_temporada" name="numero_temporada" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach (config('valores.numeros_ordinarios') as $numero)
                                        <option {{ $registro->numero_temporada == $numero ? "selected" : "" }} value="{{ $numero }}">{{ $numero }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-md" id="div-notificacion">
                    </div>
                </div>
                <input type="hidden" name="proyecto_id" id="proyecto_id" value="{{ $registro->proyecto_id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>