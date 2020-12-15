jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos-resultados-analisis", // ID de la tabla
			"#carga-dt-resultados-analisis", // ID elemento del progreso
			"/dashboard/resultados-analisis/carga/"+ $('#id').val(), // URL datos
			[
            { data: "fecha_analisis", width: "20%"},
            { data: "nomenclatura",   width: "20%"},
            { data: "nombre",         width: "25%"},
            { data: "imagen",         width: "20%"},
            { data: "acciones",       width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function agregarResultados(solicitudes_analisis_muestras_id)
{
  _mostrarFormulario("/dashboard/resultados-analisis/create/", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-resultado", //Nombre modal
                      "#fecha_analisis", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#ventana-resultados-nombre_obra_solicitud').text($('#nombre_obra').text());
                        $('#ventana-resultados-folio_obra_solicitud').text($('#folio_obra').text());

                        $('#solicitudes_analisis_muestras_id').val(solicitudes_analisis_muestras_id);
                       
                        $('#forma_obtencion_muestra_id').select2({
                          placeholder: "Seleccione una opción"
                        });

                        $("#fecha_analisis").datepicker({
                           language:       'es',
                           format:         'yyyy-mm-dd',
                        });

                      }, //Funcion para el success
                      "#form-obras-detalle-resultados-analisis", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-resultado", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(respuesta){
                        _ocultarModal("#modal-crear-resultado", function(){
            							_recargarTabla("#dt-datos-resultados-analisis");
                          _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                          _recargarTabla("#dt-datos-solicitudes-analisis");
                          $('body').removeClass('modal-open');
            						});
                        setTimeout(function () {
                          _ocultarModal("#modal-ver-muestras", function(){
                            $('#li-solicitudes-analisis').removeClass('active');
                            $('#tab-solicitudes-analisis').removeClass('active');
                            editarResultado(respuesta.id);
                            $('#li-resultados-analisis').addClass('active');
                            $('#tab-resultados-analisis').addClass('active');
                          });
                        }, 1000);
                      });//Funcion en caso de guardar correctamente);
}

function editarResultado(resultado_analisis_id)
{
  _mostrarFormulario("/dashboard/resultados-analisis/" + resultado_analisis_id + "/edit/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear-resultado", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        // $('#solicitudes_analisis_muestras_id').val(solicitudes_analisis_muestras_id);
                        $('#ventana-resultados-nombre_obra_solicitud').text($('#nombre_obra').text());
                        $('#ventana-resultados-folio_obra_solicitud').text($('#folio_obra').text());

                        _cargarTabla(
                          "#dt-datos-analisis-realizar-resultados", // ID de la tabla
                          "#carga-dt-analisis-realizar-resultados", // ID elemento del progreso
                          "/dashboard/resultados-analisis/carga-analisis-realizar-resultados/"+ resultado_analisis_id, // URL datos
                          // "/dashboard/resultados-analisis/carga-analisis-realizar-resultados/"+ $('#id').val(), // URL datos
                          [
                                { data: "analisis_a_realizar_nombre", name: "nombre", width: "20%"},
                                { data: "tecnica_analitica_nombre",   name: "nombre", width: "20%"},
                                { data: "interpretacion",                             width: "25%"},
                                { data: "imagen",                                     width: "20%"},
                                { data: "acciones",                                   width: "15%",   searchable: false,  orderable: false},
                          ], // Columnas
                        );

                        $('#forma_obtencion_muestra_id, #tipo_material_id, #informacion_por_definir_id, #interpretacion_particular_id').select2({
                          placeholder: "Seleccione una opción"
                        });

                        $("#fecha_analisis").datepicker({
                          language:       'es',
                          format:         'yyyy-mm-dd',
                        });

                        $("#dropzone-esquema-muestra").dropzone({ 
                          url: "/dashboard/resultados-analisis/" + resultado_analisis_id + "/subir-esquema-muestra",
                          uploadMultiple: false,
                          parallelUploads: 1,
                          maxFiles: 10,
                          addRemoveLinks: false,
                          acceptedFiles: 'image/*',
                          sending: function(file, xhr, formData) {
                            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                          },
                          error: function(file, message) {
                            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message.mensaje);
                          },
                          success: function(file, message){
                            var drop    =  this;
                            setTimeout(function() {
                              drop.removeFile(file);
                              _recargarTabla("#dt-datos-resultados-analisis");
                              recargarImagenesEsquemaMuestra(resultado_analisis_id);
                            }, 1000);
                          }
                        });

                       $("#dropzone-esquema-microfotografia").dropzone({ 
                          url: "/dashboard/resultados-analisis/" + resultado_analisis_id + "/subir-esquema-microfotografia",
                          uploadMultiple: false,
                          parallelUploads: 1,
                          maxFiles: 10,
                          addRemoveLinks: false,
                          acceptedFiles: 'image/*',
                          sending: function(file, xhr, formData) {
                            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                          },
                          error: function(file, message) {
                            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message.mensaje);
                          },
                          success: function(file, message){
                            var drop    =  this;
                            setTimeout(function() {
                              drop.removeFile(file);
                              recargarImagenesEsquemaMicrofotografia(resultado_analisis_id);
                            }, 1000);
                          }
                        });

                       $('#carrusel-esquema-microfotografia, #carrusel-esquema-muestra').owlCarousel({
                           loop:      false,
                           margin:    10,
                           nav:       false,
                           center:    false
                       });

                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          if ($('body').hasClass('modal-open')) {
                            $('body').removeClass('modal-open');
                          }
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-resultados-analisis", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-resultado", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-crear-resultado", function(){
                          _recargarTabla("#dt-datos-resultados-analisis");
                          // _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                          // _recargarTabla("#dt-datos-solicitudes-analisis");
                          // verMuestras(respuesta.id);
                          $('body').removeClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarResultado(solicitudes_analisis_muestras_id)
{
  _mostrarFormulario("/dashboard/resultados-analisis/"+solicitudes_analisis_muestras_id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar-resultado", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-detalle-resultados-analisis", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-resultado", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar-resultado", function(){
            							_recargarTabla("#dt-datos-resultados-analisis");
            						});
                      });//Funcion en caso de guardar correctamente);
}

// CAMBIOS DE ESTATUS EN LOS RESULTADOS
function aprobarResultadoAnalisis(id)
{
  _mostrarFormulario("/dashboard/resultados-analisis/"+id+"/aprobar-resultado-analisis/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-aprobar-resultado-analisis", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-resultado-analisis", //ID del Formulario
                  "", //Loading de guardar datos de formulario
                  "#div-notificacion-resultado-analisis", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-aprobar-resultado-analisis", function(){
                      _recargarTabla("#dt-datos-resultados-analisis");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function rechazarResultadoAnalisis(id)
{
  _mostrarFormulario("/dashboard/resultados-analisis/"+id+"/rechazar-resultado-analisis/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-rechazar-resultado-analisis", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-resultado-analisis", //ID del Formulario
                  "", //Loading de guardar datos de formulario
                  "#div-notificacion-resultado-analisis", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-rechazar-resultado-analisis", function(){
                      _recargarTabla("#dt-datos-resultados-analisis");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function ponerEnRevisionResultadoAnalisis(id)
{
  _mostrarFormulario("/dashboard/resultados-analisis/"+id+"/poner-en-revision-resultado-analisis/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-poner-en-revision-resultado-analisis", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-resultado-analisis", //ID del Formulario
                  "", //Loading de guardar datos de formulario
                  "#div-notificacion-resultado-analisis", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-poner-en-revision-resultado-analisis", function(){
                      _recargarTabla("#dt-datos-resultados-analisis");
                    });
                  });//Funcion en caso de guardar correctamente);
}


// RESULTADOS ANALITICOS

function crearResultadoAnalitico(id_de_resultado_analisis)
{
  _mostrarFormulario("/dashboard/resultados-analisis/crear-resultado-analitico", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-resultado-analitico", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#analisis_a_realizar_id, #tecnica_analitica_id').select2({
                          placeholder: "Seleccione una opción"
                        });
                        $('#resultado_analisis_id').val(id_de_resultado_analisis);
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-crear-resultados-analiticos", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-resultados-analiticos", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-resultado-analitico", function(){
                            _recargarTabla("#dt-datos-analisis-realizar-resultados");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function editarDatosAnaliticos(id_de_resultado_analitico)
{
  _mostrarFormulario("/dashboard/resultados-analisis/editar-resultado-analitico/"+id_de_resultado_analitico, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-resultado-analitico", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#analisis_a_realizar_id, #tecnica_analitica_id').select2({
                          placeholder: "Seleccione una opción"
                        });
                        // $('#id').val(id_de_resultado_analitico);
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });

                        $("#dropzone-esquema-analiticos-microfotografia").dropzone({ 
                          url: "/dashboard/resultados-analisis/" + id_de_resultado_analitico + "/subir-esquema-analiticos-microfotografia",
                          uploadMultiple: false,
                          parallelUploads: 1,
                          maxFiles: 10,
                          addRemoveLinks: false,
                          acceptedFiles: 'image/*',
                          sending: function(file, xhr, formData) {
                            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                          },
                          error: function(file, message) {
                            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message.mensaje);
                          },
                          success: function(file, message){
                            var drop    =  this;
                            setTimeout(function() {
                              drop.removeFile(file);
                              _recargarTabla("#dt-datos-analisis-realizar-resultados");
                              recargarImagenesEsquemaAnaliticosMicrofotografia(id_de_resultado_analitico);
                            }, 1000);
                          }
                        });

                       $('#carrusel-esquema-analiticos-microfotografia').owlCarousel({
                           loop:      false,
                           margin:    10,
                           nav:       false,
                           center:    false
                       });
                      }, //Funcion para el success
                      "#form-obras-detalle-crear-resultados-analiticos", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-resultados-analiticos", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-resultado-analitico", function(){
                            _recargarTabla("#dt-datos-analisis-realizar-resultados");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarDatosAnaliticos(id_de_resultado_analitico)
{
  _mostrarFormulario("/dashboard/resultados-analisis/aviso-eliminar-resultado-analitico/"+id_de_resultado_analitico, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-resultado-analitico", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-eliminar-resultado-analitico", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-eliminar-resultado-analitico", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-resultado-analitico", function(){
                          _recargarTabla("#dt-datos-analisis-realizar-resultados");
                          // evita el freezing cuando se completa la operacion correctamente
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}


// IMAGENES
function eliminarImagenEsquemaResultadoAnalisisMuestra(id, resultado_analisis_id){
  _mostrarFormulario("/dashboard/resultados-analisis/"+id+"/eliminar-esquema-muestra/", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-imagen-resultado", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-eliminar-imagen-resultado", //ID del Formulario
                      "#carga-eliminar-imagen-resultado", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-imagen-resultado", function(){
                          _recargarTabla("#dt-datos-resultados-analisis");
                          recargarImagenesEsquemaMuestra(resultado_analisis_id);
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarImagenEsquemaResultadoAnalisisMicrofotografia(id, resultado_analisis_id){
  _mostrarFormulario("/dashboard/resultados-analisis/"+id+"/eliminar-esquema-microfotografia/", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-esquema-microfotografia", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-eliminar-esquema-microfotografia", //ID del Formulario
                      "#carga-eliminar-esquema-microfotografia", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-esquema-microfotografia", function(){
                          recargarImagenesEsquemaMicrofotografia(resultado_analisis_id);
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarImagenEsquemaAnaliticosMicrofotografia(id, analisis_a_realizar_resultado_id){
  _mostrarFormulario("/dashboard/resultados-analisis/"+id+"/eliminar-esquema-analiticos-microfotografia/", //Url solicitud de datos
                      "#modal-3", //Div que contendra el modal
                      "#modal-eliminar-esquema-analiticos-microfotografia", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-eliminar-esquema-analiticos-microfotografia", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-eliminar-esquema-analiticos-microfotografia", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-esquema-analiticos-microfotografia", function(){
                          _recargarTabla("#dt-datos-analisis-realizar-resultados");
                          recargarImagenesEsquemaAnaliticosMicrofotografia(analisis_a_realizar_resultado_id);
                        });
                      });//Funcion en caso de guardar correctamente);
}

function recargarImagenesEsquemaMuestra(resultado_analisis_id){
  $.ajax({
    url: '/dashboard/resultados-analisis/' + resultado_analisis_id + '/ver-esquema-muestra',
    type: 'GET',
    success: function(respuesta){
      $("#contenedor-esquema-muestra").html(respuesta);
      $('#carrusel-esquema-muestra').owlCarousel({
        loop:      false,
        margin:    10,
        nav:       false,
        center:    false
      });
    },
    error: function(){
      _toast("error", "Hubo un error al obtener las imagenes, intenta de nuevo mas tarde");
    }
  });  
}

function recargarImagenesEsquemaMicrofotografia(resultado_analisis_id){
  $.ajax({
    url: '/dashboard/resultados-analisis/' + resultado_analisis_id + '/ver-esquema-microfotografia',
    type: 'GET',
    success: function(respuesta){
      $("#contenedor-esquema-microfotografia").html(respuesta);
      $('#carrusel-esquema-microfotografia').owlCarousel({
        loop:      false,
        margin:    10,
        nav:       false,
        center:    false
      });
    },
    error: function(){
      _toast("error", "Hubo un error al obtener las imagenes, intenta de nuevo mas tarde");
    }
  });  
}

function recargarImagenesEsquemaAnaliticosMicrofotografia(id_de_analisis_a_realizar_resultado){
  $.ajax({
    url: '/dashboard/resultados-analisis/' + id_de_analisis_a_realizar_resultado + '/ver-esquema-analiticos-microfotografia',
    type: 'GET',
    success: function(respuesta){
      $("#contenedor-esquema-analiticos-microfotografia").html(respuesta);
      $('#carrusel-esquema-analiticos-microfotografia').owlCarousel({
        loop:      false,
        margin:    10,
        nav:       false,
        center:    false
      });
    },
    error: function(){
      _toast("error", "Hubo un error al obtener las imagenes, intenta de nuevo mas tarde");
    }
  });  
}