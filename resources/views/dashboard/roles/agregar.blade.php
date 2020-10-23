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
                            <div class="col-md-12 div-input required">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                            <div class="col-md-12 div-input required">
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
                                {{-- CAPTURA --}}
                                <tr>
                                    <th rowspan="9">CAPTURA</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_solicitud_obra"  {{ (($registro->captura_solicitud_obra == 1) ? 'checked=""' : '') }} ><i></i> Captura de solicitud obra
                                            </label>
                                        </div>                            
                                    </td>
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
                                                <input type="checkbox" name="captura_de_registro_avanzada"  {{ (($registro->captura_de_registro_avanzada == 1) ? 'checked=""' : '') }} ><i></i> Captura de registro avanzada
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_responsables_intervencion"  {{ (($registro->captura_de_responsables_intervencion == 1) ? 'checked=""' : '') }} ><i></i> Captura de responsables de intervención
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_catalogos_basica"  {{ (($registro->captura_de_catalogos_basica == 1) ? 'checked=""' : '') }} ><i></i> Captura de catálogos básica
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_catalogos_avanzada"  {{ (($registro->captura_de_catalogos_avanzada == 1) ? 'checked=""' : '') }} ><i></i> Captura de catálogos avanzada
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_solicitud_analisis"  {{ (($registro->captura_de_solicitud_analisis == 1) ? 'checked=""' : '') }} ><i></i> Captura de solicitud de análisis
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="captura_de_resultados"  {{ (($registro->captura_de_resultados == 1) ? 'checked=""' : '') }} ><i></i> Captura de resultados
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                {{-- EDICIÓN --}}
                                <tr>
                                    <th rowspan="4">EDICIÓN</th>
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
                                {{-- ELIMINACIÓN --}}
                                <tr>
                                    <th rowspan="6">ELIMINACIÓN</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="eliminar_solicitud_obra"  {{ (($registro->eliminar_solicitud_obra == 1) ? 'checked=""' : '') }} ><i></i> Eliminar solicitud de obra
                                            </label>
                                        </div>                            
                                    </td>
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
                                                <input type="checkbox" name="eliminar_solicitud_analisis"  {{ (($registro->eliminar_solicitud_analisis == 1) ? 'checked=""' : '') }} ><i></i> Eliminar solicitud análisis
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
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="eliminar_catalogos"  {{ (($registro->eliminar_catalogos == 1) ? 'checked=""' : '') }} ><i></i> Eliminar catálogos
                                        </div>                            
                                    </td>
                                </tr>
                                {{-- ACCESO --}}
                                <tr>
                                    <th rowspan="5">ACCESO</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="acceso_a_lista_solicitudes_analisis"  {{ (($registro->acceso_a_lista_solicitudes_analisis == 1) ? 'checked=""' : '') }} ><i></i> Acceso a listado de solicitudes de análisis
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="acceso_a_lista_solicitudes_obras"  {{ (($registro->acceso_a_lista_solicitudes_obras == 1) ? 'checked=""' : '') }} ><i></i> Acceso a listado de solicitudes de obras
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="acceso_a_datos_basico"  {{ (($registro->acceso_a_datos_basico == 1) ? 'checked=""' : '') }} ><i></i> Acceso a datos básico
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="acceso_a_datos_avanzado"  {{ (($registro->acceso_a_datos_avanzado == 1) ? 'checked=""' : '') }} ><i></i> Acceso a datos avanzado
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                {{-- CONSULTA --}}
                                <tr>
                                    <th rowspan="5">CONSULTA</th>
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
                                                <input type="checkbox" name="consulta_general_avanzada"  {{ (($registro->consulta_general_avanzada == 1) ? 'checked=""' : '') }} ><i></i> Consulta general avanzada
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
                                                <input type="checkbox" name="consulta_estadistica"  {{ (($registro->consulta_estadistica == 1) ? 'checked=""' : '') }} ><i></i> Consulta de estadisticas
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                {{-- IMPRIMIR --}}
                                <tr>
                                    <th rowspan="3">IMPRESIÓN</th>
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
                                                <input type="checkbox" name="imprimir_oficios"  {{ (($registro->imprimir_oficios == 1) ? 'checked=""' : '') }} ><i></i> Imprimir
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="5">ADMINISTRACIÓN DEL SISTEMA</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="creacion_usuarios_permisos"  {{ (($registro->creacion_usuarios_permisos == 1) ? 'checked=""' : '') }} ><i></i> Administración de usuarios y permisos
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="administrar_solicitudes_obras"  {{ (($registro->administrar_solicitudes_obras == 1) ? 'checked=""' : '') }} ><i></i> Administración de solicitudes de obra
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="administrar_solicitudes_analisis"  {{ (($registro->administrar_solicitudes_analisis == 1) ? 'checked=""' : '') }} ><i></i> Administración de solicitudes de análisis
                                            </label>
                                        </div>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" name="administrar_registro_resultados"  {{ (($registro->administrar_registro_resultados == 1) ? 'checked=""' : '') }} ><i></i> Administración de registro de resultados
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