<div class="modal inmodal" id="modal-crear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras | Detalle | Usuarios asignados</h4>
                <small class="font-bold">Asignar nuevo usuario</small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.usuarios-asignados.store'], 'method' => 'POST', 'id' => 'form-obras-asignar-usuario', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.usuarios-asignados.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-asignar-usuario', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8 div-input required">
                                <label for="usuario_id">Usuario</label>
                                <select class="form-control select2" id="_usuario_id" name="usuario_id" required autocomplete="off">
                                    @if (isset($obra_id))
                                        @foreach ($usuariosParaAsignar as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ $registro->usuario->id }}">{{ $registro->usuario->name }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 div-input required">
                                <label for="usuario_id">Status</label>
                                <select class="form-control select2" id="_status" name="status" required autocomplete="off">
                                    @foreach (config('valores.status_usuarios') as $status)
                                        <option {{ $registro->status == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
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
                    <button type="submit" class="btn btn-primary">Asignar usuario</button>
                </div>

                @isset ($obra_id)
                    <input type="hidden" name="obra_id" value="{{ $obra_id }}">}
                @endisset
            {!! Form::close() !!}
        </div>
    </div>
</div>