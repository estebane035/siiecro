jQuery(document).ready(function($) {
	$("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca, #area_id, #_responsables, #forma_ingreso, #usuario_recibio_id").select2({
        placeholder: "Seleccione una opción"
    });

    $("#modalidad, #proyecto_id").select2();

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

    _llenarSelect2Estatico("#proyecto_id", "/dashboard/proyectos/select2", {
        area_id:        $("#area_id").val(),
        forma_ingreso:  $("#forma_ingreso").val()
    }, false);

    _llenarSelect2Estatico("#_temporadas_trabajo", "/dashboard/proyectos/temporadas-trabajo/select2", {
        proyecto_id:    $("#proyecto_id").val()
    }, false, false);

    _formAjax(
              "#form-general", // Formulario
              "", // Div progreso
              "#div-notificacion-general", // Div notificacion
              function(){
                location.reload();
              }
            );

    _formAjax(
              "#form-datos-identificacion", // Formulario
              "", // Div progreso
              "#div-respuesta-datos-identificacion", // Div notificacion
              function(){
                location.reload();
              }
            );

    $('#area_id').on('select2:select', function (e) {
        inicializarSelect2Proyecto();
    });

    $('#forma_ingreso').on('select2:select', function (e) {
        inicializarSelect2Proyecto();
    });

    $('#proyecto_id').on('select2:select', function (e) {
        comportamientoSelectProyecto();
    });

    $('#proyecto_id').on('select2:unselect', function (e) {
        comportamientoSelectProyecto(true);
    });
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

function toggleEdicionDatosGenerales(estatus){
  // True: Habilitar edicion
  // False: Deshabilitar edicion
  if(estatus){
    $("#form-general").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', false);
    $("#btn-group-habilitar-edicion").addClass('hidden');
    $("#btn-group-editar").removeClass('hidden');
  } else{
    $("#form-general").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', true);
    $("#btn-group-habilitar-edicion").removeClass('hidden');
    $("#btn-group-editar").addClass('hidden');
  }
}

function toggleEdicionDatosIdentificacion(estatus){
  // True: Habilitar edicion
  // False: Deshabilitar edicion
  if(estatus){
    $("#form-datos-identificacion").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', false);
    $("#btn-group-habilitar-edicion-datos-identificacion").addClass('hidden');
    $("#btn-group-editar-datos-identificacion").removeClass('hidden');
  } else{
    $("#form-datos-identificacion").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', true);
    $("#btn-group-habilitar-edicion-datos-identificacion").removeClass('hidden');
    $("#btn-group-editar-datos-identificacion").addClass('hidden');
  }
}

function inicializarSelect2Proyecto(limpiar = true){
    $("#div-proyecto").removeClass('hidden');
    _llenarSelect2Estatico("#proyecto_id", "/dashboard/proyectos/select2", {
        area_id:        $("#area_id").val(),
        forma_ingreso:  $("#forma_ingreso").val()
    }, limpiar);
    comportamientoSelectProyecto(true);
}

function comportamientoSelectProyecto(ocultar = false, limpiar = true){
    if(ocultar){
        $("#div-temporadas-trabajo").addClass('hidden');
        $("#_temporadas_trabajo").empty().trigger("change");
    } else{
        $("#div-temporadas-trabajo").removeClass('hidden');
        _llenarSelect2Estatico("#_temporadas_trabajo", "/dashboard/proyectos/temporadas-trabajo/select2", {
            proyecto_id:    $("#proyecto_id").val()
        }, limpiar, false);
    }
}