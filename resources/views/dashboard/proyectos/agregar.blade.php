<div class="modal inmodal" id="modal-crear" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Proyectos</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nuevo Proyecto" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.proyectos.store'], 'method' => 'POST', 'id' => 'form-proyectos', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.proyectos.update', $registro->id], 'method' => 'PUT', 'id' => 'form-proyectos', 'class' => 'form-horizontal']) !!}
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
                            <div class="col-md-12 div-input required">
                                <label for="area_id">Área</label>
                                <select class="form-control select2 full-width" id="area_id" name="area_id" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($areas as $area)
                                        <option {{ $registro->area_id == $area->id ? "selected" : "" }} value="{{ $area->id }}">{{ $area->campo }} {{ $area->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 div-input required">
                                <label for="forma_ingreso">Status</label>
                                <select class="form-control select2 full-width" id="status" name="status" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach (config('valores.status_abierto_cerrado') as $status)
                                        <option {{ $registro->status == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input required">
                                <label for="forma_ingreso">Forma de ingreso</label>
                                <select class="form-control select2 full-width" id="forma_ingreso" name="forma_ingreso" required autocomplete="off">
                                    <option value=""></option>
                                    @foreach (config('valores.obras_formas_ingreso') as $forma)
                                        <option {{ $registro->forma_ingreso == $forma ? "selected" : "" }} value="{{ $forma }}">{{ $forma }}</option>
                                    @endforeach
                                </select>
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