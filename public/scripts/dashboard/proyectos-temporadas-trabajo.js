jQuery(document).ready(function($) {
  var proyecto_id   =   $("#_proyecto_id").val();
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/proyectos/temporadas-trabajo/carga/" + proyecto_id, // URL datos
			[
				{ data: "año",        width: "85%"},
				{ data: "acciones",   width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(proyecto_id){
  _mostrarFormulario("/dashboard/proyectos/temporadas-trabajo/create/" + proyecto_id, //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#año", //Elemento al que se le dara focus una vez cargado el modal
                    function(){
                      $("#proyecto_id").val(proyecto_id);
                      $("#año").datepicker({
                        language:       'es',
                        format:         'yyyy',
                        minViewMode:    'years',

                      });
                    }, //Funcion para el success
                    "#form-temporadas-trabajo", //ID del Formulario
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
    _mostrarFormulario("/dashboard/proyectos/temporadas-trabajo/"+id+"/edit/", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#año", //Elemento al que se le dara focus una vez cargado el modal
                    function(){
                      $("#año").datepicker({
                        language:       'es',
                        format:         'yyyy',
                        minViewMode:    'years',

                      });
                    }, //Funcion para el success
                    "#form-temporadas-trabajo", //ID del Formulario
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
  _mostrarFormulario("/dashboard/proyectos/temporadas-trabajo/"+id+"/eliminar/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-eliminar", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-temporadas-trabajo", //ID del Formulario
                  "#carga-eliminar", //Loading de guardar datos de formulario
                  "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
        						_ocultarModal("#modal-eliminar", function(){
        							_recargarTabla("#dt-datos");
        						});
                  });//Funcion en caso de guardar correctamente);
}