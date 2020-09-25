jQuery(document).ready(function($) {
	$("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca, #area_id, #_responsables, #forma_ingreso").select2({
        placeholder: "Seleccione una opción"
  });

  $("#año").datepicker({
    language:       'es',
    format:         'yyyy',
    minViewMode:    'years',
    startDate:      '1400',
    endDate:        '2040',
  });

  $("#fecha_ingreso, #fecha_salida").datepicker({
  	language:       'es',
      format:         'yyyy-mm-dd',
  });

  $('#tipo_bien_cultural_id').on('select2:select', function (e) {
      comportamientoTipoBienCultural(e.params.data.id);
  });

  $('#estatus_epoca').on('select2:select', function (e) {
      comportamientoStatusEpoca(e.params.data.id);
  });

  comportamientoTipoBienCultural($('#tipo_bien_cultural_id').val());
  comportamientoStatusEpoca($('#estatus_epoca').val());

  _formAjax(
              "#form-general", // Formulario
              "", // Div progreso
              "#div-notificacion-general", // Div notificacion
              function(){
              }
            );
});

function comportamientoTipoBienCultural(id){
  // Obtenemos el option del id seleccionado
  var   option  =   $("#tipo-bien-cultural-" + id);

  // Guardamos en un input si se calcula la temporalidad o no
  // Se necesitara en el controlador
  $("#calcular-temporalidad").val(option.attr('calcular-temporalidad'));

  // Si el atributo calcular-temporalidad del option es si entonces mostramos el div de temporalidad y cultura
  // Si no mostramos el div de epoca y autor
  if(option.attr('calcular-temporalidad') == "si"){
    $("#div-temporalidad").removeClass('hidden');
    $("#div-cultura").removeClass('hidden');

    $("#div-epoca").addClass('hidden');
    $("#div-autor").addClass('hidden');
  } else{
    $("#div-epoca").removeClass('hidden');
    $("#div-autor").removeClass('hidden');

    $("#div-temporalidad").addClass('hidden');
    $("#div-cultura").addClass('hidden');
  }
}

function comportamientoStatusEpoca(id){
  // Si el status es confirmado entonces mostramos el div de epoca
  // Si no entonces lo ocultamos
  if(id == "Confirmado"){
    $("#div-año").removeClass('hidden');
  }else{
    $("#div-año").addClass('hidden');
  }
}