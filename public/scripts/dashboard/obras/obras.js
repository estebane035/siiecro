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
                    "#name", //Elemento al que se le dara focus una vez cargado el modal
                    function(){
                      $("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id").select2({
                        placeholder: "Seleccione una opción"
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
                    "#name", //Elemento al que se le dara focus una vez cargado el modal
                    function(){
                      $("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id").select2({
                        placeholder: "Seleccione una opción"
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