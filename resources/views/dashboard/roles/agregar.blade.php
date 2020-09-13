<div class="modal inmodal" id="modal-crear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Roles</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nuevo Rol" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.roles.store'], 'method' => 'POST', 'id' => 'form-roles', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.roles.update', $registro->id], 'method' => 'PUT', 'id' => 'form-roles', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                            <div class="col-md-12 div-input">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $registro->descripcion }}" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="2">PERMISOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th rowspan="7">CAPTURA</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_registro_basica"  {{ (($registro->captura_de_registro_basica == 1) ? 'checked=""' : '') }} ><i></i> Captura de registro basica
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_registro_avanzada_1"  {{ (($registro->captura_de_registro_avanzada_1 == 1) ? 'checked=""' : '') }} ><i></i> Captura de registro avanzada 1
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_registro_avanzada_2"  {{ (($registro->captura_de_registro_avanzada_2 == 1) ? 'checked=""' : '') }} ><i></i> Captura de registro avanzada 2
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_solicitud"  {{ (($registro->captura_de_solicitud == 1) ? 'checked=""' : '') }} ><i></i> Captura de solicitud
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_resultados_basica"  {{ (($registro->captura_de_resultados_basica == 1) ? 'checked=""' : '') }} ><i></i> Captura de resultados básica
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_resultados_avanzada"  {{ (($registro->captura_de_resultados_avanzada == 1) ? 'checked=""' : '') }} ><i></i> Captura de resultados avanzada
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="7">EDICIÓN</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="edicion_de_registro_basica"  {{ (($registro->edicion_de_registro_basica == 1) ? 'checked=""' : '') }} ><i></i> Edición de registro basica
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="edicion_de_registro_avanzada_1"  {{ (($registro->edicion_de_registro_avanzada_1 == 1) ? 'checked=""' : '') }} ><i></i> Edición de registro avanzada 1
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="edicion_de_registro_avanzada_2"  {{ (($registro->edicion_de_registro_avanzada_2 == 1) ? 'checked=""' : '') }} ><i></i> Edición de registro avanzada 2
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="edicion_de_solicitud"  {{ (($registro->edicion_de_solicitud == 1) ? 'checked=""' : '') }} ><i></i> Edición de solicitud
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="edicion_de_resultados_basica"  {{ (($registro->edicion_de_resultados_basica == 1) ? 'checked=""' : '') }} ><i></i> Edición de resultados básica
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="edicion_de_resultados_avanzada"  {{ (($registro->edicion_de_resultados_avanzada == 1) ? 'checked=""' : '') }} ><i></i> Edición de resultados avanzada
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="4">ELIMINACIÓN</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="eliminar_registro"  {{ (($registro->eliminar_registro == 1) ? 'checked=""' : '') }} ><i></i> Eliminar registro
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="eliminar_solicitud"  {{ (($registro->eliminar_solicitud == 1) ? 'checked=""' : '') }} ><i></i> Eliminar solicitud
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="eliminar_resultados"  {{ (($registro->eliminar_resultados == 1) ? 'checked=""' : '') }} ><i></i> Eliminar resultados
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="7">CONSULTA</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="consulta_general_basica"  {{ (($registro->consulta_general_basica == 1) ? 'checked=""' : '') }} ><i></i> Consulta general basica
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="consulta_general_avanzada_1"  {{ (($registro->consulta_general_avanzada_1 == 1) ? 'checked=""' : '') }} ><i></i> Consulta general avanzada 1
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="consulta_general_avanzada_2"  {{ (($registro->consulta_general_avanzada_2 == 1) ? 'checked=""' : '') }} ><i></i> Consulta general avanzada 2
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="consulta_externa"  {{ (($registro->consulta_externa == 1) ? 'checked=""' : '') }} ><i></i> Consulta externa
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="imprimir_condicionado"  {{ (($registro->imprimir_condicionado == 1) ? 'checked=""' : '') }} ><i></i> Imprimir condicionado
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="imprimir"  {{ (($registro->imprimir == 1) ? 'checked=""' : '') }} ><i></i> Imprimir
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2">ADMINISTRACIÓN DEL SISTEMA</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="admin_de_usuarios"  {{ (($registro->admin_de_usuarios == 1) ? 'checked=""' : '') }} ><i></i> Administración de usuarios
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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