jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos-solicitudes-analisis", // ID de la tabla
			"#carga-dt-solicitudes-analisis", // ID elemento del progreso
			"/dashboard/solicitudes-analisis/carga", // URL datos
			[
        // aquí si le dejé el id por si se repite la técnica, que identifiquen cual registro eliminarán
        { data: "tecnica",            width: "20%"},
        { data: "fecha_intervencion", width: "20%"},
        { data: "name",               width: "25%"},
        { data: "esquema",            width: "25%"},
				{ data: "acciones",           width: "10%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear()
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/create", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#tecnica", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#obra_id').val($('#id').val());
                       
                        $('#obra_usuario_asignado_id').select2({
                          placeholder: "Seleccione una opción"
                        });

                        $("#fecha_intervencion").datepicker({
                            language:       'es',
                            format:         'yyyy-mm-dd',
                          });
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear", function(){
              							_recargarTabla("#dt-datos-solicitudes-analisis");
              						});
                      });//Funcion en caso de guardar correctamente);
}

function editar(id)
{
    _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/edit/", //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-crear", //Nombre modal
                        "#tecnica", //Elemento al que se le dara focus una vez cargado el modal
                        function(){
                          $('#obra_usuario_asignado_id').select2({
                            placeholder: "Seleccione una opción"
                          });
                          
                          $("#fecha_intervencion").datepicker({
                            language:       'es',
                            format:         'yyyy-mm-dd',
                          });
                        }, //Funcion para el success
                        "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                        "#carga-agregar", //Loading de guardar datos de formulario
                        "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                        function(){
                            _ocultarModal("#modal-crear", function(){
                							_recargarTabla("#dt-datos-solicitudes-analisis");
                						});
                        });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-datos-solicitudes-analisis");
            						});
                      });//Funcion en caso de guardar correctamente);
}

// MUESTRAS 

function verMuestras(id)
{
    _mostrarFormulario("/dashboard/solicitudes-analisis/ver-muestras/"+id, //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-ver-muestras", //Nombre modal
                        "#tecnica", //Elemento al que se le dara focus una vez cargado el modal
                        function(){
                          _cargarTabla(
                            "#dt-datos-solicitudes-analisis-muestras", // ID de la tabla
                            "#carga-dt-solicitudes-analisis-muestras", // ID elemento del progreso
                            "/dashboard/solicitudes-analisis/cargar-muestras/"+id, // URL datos
                            [
                              { data: "nombre",                 width: "20%"},
                              { data: "no_muestra",             width: "10%"},
                              { data: "nomenclatura",           width: "10%"},
                              { data: "informacion_requerida",  width: "10%"},
                              { data: "motivo",                 width: "15%"},
                              { data: "descripcion_muestra",    width: "15%"},
                              { data: "ubicacion",              width: "10%"},
                              { data: "acciones",               width: "10%",   searchable: false,  orderable: false},
                            ], // Columnas
                          );
                        }, //Funcion para el success
                        "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                        "#carga-agregar", //Loading de guardar datos de formulario
                        "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                        function(){
                            _ocultarModal("#modal-crear", function(){
                              _recargarTabla("#dt-datos-solicitudes-analisis");
                            });
                        });//Funcion en caso de guardar correctamente);
}

function crearMuestra(id_de_solicitud)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/crear-muestra", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-muestra", //Nombre modal
                      "#no_muestra", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#tipo_analisis_id').select2({
                          placeholder: "Seleccione una opción"
                        });
                        $('#solicitud_analisis_id').val(id_de_solicitud);
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis-crear-muestra", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion-muestra", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-muestra", function(){
                            _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                          });
                      });//Funcion en caso de guardar correctamente);
}

function editarMuestra(id_de_muestra)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/editar-muestra/"+id_de_muestra, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-muestra", //Nombre modal
                      "#no_muestra", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#tipo_analisis_id').select2({
                          placeholder: "Seleccione una opción"
                        });
                        $('#solicitud_analisis_id').val($('#id_de_solicitud').val());
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis-crear-muestra", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion-muestra", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-muestra", function(){
                            _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                          });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarMuestra(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/aviso-eliminar-muestra/"+id, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-muestra", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis-eliminar-muestra", //ID del Formulario
                      "#carga-eliminar-muestra", //Loading de guardar datos de formulario
                      "#div-notificacion-eliminar-muestra", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-muestra", function(){
                          _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                        });
                      });//Funcion en caso de guardar correctamente);
}