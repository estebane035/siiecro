jQuery(document).ready(function($) {
  _cargarTabla(
      "#dt-datos", // ID de la tabla
      "#carga-dt", // ID elemento del progreso
      "/dashboard/obras/carga", // URL datos
      [
        { data: "folio",     width: "20%"},
        { data: "nombre",     width: "65%"},
        { data: "acciones",   width: "15%",   searchable: false,  orderable: false},
      ], // Columnas
    );
});

function crear(){
  _mostrarFormulario("/dashboard/obras/create", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                    function(){

                      $("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca").select2({
                        placeholder: "Seleccione una opción"
                      });

                      $("#año").datepicker({
                        language:       'es',
                        format:         'yyyy',
                        minViewMode:    'years',
                        startDate:      '1400',
                        endDate:        '2040',
                      });

                      $('#tipo_bien_cultural_id').on('select2:select', function (e) {
                        comportamientoTipoBienCultural(e.params.data.id);
                      });

                      $('#estatus_año').on('select2:select', function (e) {
                        comportamientoStatusAño(e.params.data.id);
                      });

                    }, //Funcion para el success
                    "#form-obras", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                        _ocultarModal("#modal-crear", function(){
                          _recargarTabla("#dt-datos");
                        });
                    });//Funcion en caso de guardar correctamente);
}

function editar(id)
{
    _mostrarFormulario("/dashboard/obras/"+id+"/edit/", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                    function(){

                      $("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca").select2({
                        placeholder: "Seleccione una opción"
                      });

                      $("#año").datepicker({
                        language:       'es',
                        format:         'yyyy',
                        minViewMode:    'years',
                        startDate:      '1400',
                        endDate:        '2040',
                      });

                    }, //Funcion para el success
                    "#form-obras", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                        _ocultarModal("#modal-crear", function(){
                          _recargarTabla("#dt-datos");
                        });
                    });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/dashboard/obras/"+id+"/eliminar/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-eliminar", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-obras", //ID del Formulario
                  "#carga-eliminar", //Loading de guardar datos de formulario
                  "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-eliminar", function(){
                      _recargarTabla("#dt-datos");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function comportamientoTipoBienCultural(id){
  // Obtenemos el option del id seleccionado
  var   option  =   $("#tipo-bien-cultural-" + id);

  // Guardamos en un input si se calcula la temporalidad o no
  // Se necesitara en el controlador
  $("#calcular-temporalidad").val(option.attr('calcular-temporalidad'));

  // Si el atributo calcular-temporalidad del option es si entonces mostramos el div de temporalidad y cultura
  // Si no mostramos el div de año y autor
  if(option.attr('calcular-temporalidad') == "si"){
    $("#div-temporalidad").removeClass('hidden');
    $("#div-cultura").removeClass('hidden');

    $("#div-año").addClass('hidden');
    $("#div-autor").addClass('hidden');
  } else{
    $("#div-año").removeClass('hidden');
    $("#div-autor").removeClass('hidden');

    $("#div-temporalidad").addClass('hidden');
    $("#div-cultura").addClass('hidden');
  }
}

function comportamientoStatusAño(id){
  // Si el status es confirmado entonces mostramos el div de epoca
  // Si no entonces lo ocultamos
  if(id == "Confirmado"){
    $("#div-epoca").removeClass('hidden');
  }else{
    $("#div-epoca").addClass('hidden');
  }
}