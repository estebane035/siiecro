jQuery(document).ready(function($) {
  _cargarTabla(
      "#dt-datos", // ID de la tabla
      "#carga-dt", // ID elemento del progreso
      "/dashboard/obras/carga", // URL datos
      [
        { data: "folio",                width: "10%"},
        { data: "nombre",               width: "20%"},
        { data: "tipo_bien_cultural",   width: "15%",   name: "obc.nombre"},
        { data: "tipo_objeto",          width: "10%",   name: "oto.nombre"},
        { data: "año",                  width: "5%"},
        { data: "epoca",                width: "10%",   name: "oe.nombre"},
        { data: "temporalidad",         width: "10%",   name: "ot.nombre"},
        { data: "nombre_area",          width: "20%",   name: "a.nombre"},
        { data: "acciones",             width: "15%",   searchable: false,  orderable: false},
      ], // Columnas
    );
});

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

function importarObras(){
  _mostrarFormulario("/dashboard/obras/importar", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-importar", //Nombre modal
                      "#name", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-importar", //ID del Formulario
                      "#carga-importar", //Loading de guardar datos de formulario
                      "#div-notificacion-importar", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-importar", function(){
                            _recargarTabla("#dt-datos");
                          });
                      });//Funcion en caso de guardar correctamente);
}