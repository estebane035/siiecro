<div class="modal inmodal" id="modal-crear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Usuarios</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nuevo usuario" : "Editando a " }} <strong>{{ $registro->name }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.usuarios.store'], 'method' => 'POST', 'id' => 'form-usuarios', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.usuarios.update', $registro->id], 'method' => 'PUT', 'id' => 'form-usuarios', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 div-input">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $registro->name }}" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $registro->email }}" autocomplete="off" required>
                            </div>
                            <div class="col-md-12 div-input">
                                <label for="rol_id">Rol</label>
                                <select class="form-control select2" name="rol_id" id="rol_id" autocomplete="off" required>
                                    @foreach ($roles as $rol)
                                        <option {{ $registro->rol_id == $rol->id ? "selected" : "" }} value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 div-input">
                                <label for="area_id">Área</label>
                                <select class="form-control select2" name="area_id" id="area_id" autocomplete="off">
                                    <option value="">Sin Área</option>
                                    @foreach ($areas as $area)
                                        <option {{ $registro->area_id == $area->id ? "selected" : "" }} value="{{ $area->id }}">{{ $area->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" autocomplete="off" {{ $registro == "[]" ? "required" : "" }}>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="repetir_contraseña">Repetir Contraseña</label>
                                <input type="password" class="form-control" id="repetir_contraseña" name="repetir_contraseña" autocomplete="off" {{ $registro == "[]" ? "required" : "" }}>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="es_responsable_ecro" class="pointer">Es responsable ECRO</label>
                                <div class="i-checks pull-right">
                                    <input type="checkbox" id="es_responsable_ecro" name="es_responsable_ecro"  {{ $registro->es_responsable_ecro ? 'checked=""' : '' }} >
                                </div>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="es_responsable_intervencion" class="pointer">Es responsable de intervención</label>
                                <div class="i-checks pull-right">
                                    <input type="checkbox" id="es_responsable_intervencion" name="es_responsable_intervencion"  {{ $registro->es_responsable_intervencion ? 'checked=""' : '' }} >
                                </div>
                            </div>
                            <div class="col-md-6 div-input ">
                                <label for="puede_recibir_obras" class="pointer">Puede recibir obras</label>
                                <div class="i-checks pull-right">
                                    <input type="checkbox" id="puede_recibir_obras" name="puede_recibir_obras"  {{ $registro->puede_recibir_obras ? 'checked=""' : '' }} >
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