<div class="modal inmodal" id="modal-crear" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Obra" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras.store'], 'method' => 'POST', 'id' => 'form-obras', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="autor">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="{{ $registro->autor }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 div-input">
                                <label for="tipo_bien_cultural_id">Tipo de bien cultural</label>
                                <select class="form-control select2" id="tipo_bien_cultural_id" name="tipo_bien_cultural_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tiposBienCultural as $bienCultural)
                                        <option {{ $bienCultural->id == $registro->id ? "selected" : "" }} value="{{ $bienCultural->id }}">{{ $bienCultural->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="tipo_objeto_id">Tipo de objeto</label>
                                <select class="form-control select2" id="tipo_objeto_id" name="tipo_objeto_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($tiposObjeto as $objeto)
                                        <option {{ $objeto->id == $registro->id ? "selected" : "" }} value="{{ $objeto->id }}">{{ $objeto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="cultura">Cultura</label>
                                <input type="text" class="form-control" id="cultura" name="cultura" value="{{ $registro->cultura }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="temporalidad_id">Temporalidad</label>
                                <select class="form-control select2" id="temporalidad_id" name="temporalidad_id" required autocomplete="off">
                                    <option value=""></option>
                                    <option value="1">TMP</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 div-input">
                                <label for="lugar_procedencia_actual">Lugar de procedencia actual</label>
                                <input type="text" class="form-control" id="lugar_procedencia_actual" name="lugar_procedencia_actual" value="{{ $registro->lugar_procedencia_actual }}" required autocomplete="off">
                            </div>
                            <div class="col-md-4 div-input">
                                <label for="numero_inventario">No inventario</label>
                                <input type="text" class="form-control" id="numero_inventario" name="numero_inventario" value="{{ $registro->numero_inventario }}" required autocomplete="off">
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