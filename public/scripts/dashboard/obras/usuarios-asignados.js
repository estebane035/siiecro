jQuery(document).ready(function($) {
  _cargarTabla(
    "#dt-usuarios-asignados", // ID de la tabla
    "#carga-dt-usuarios-asignados", // ID elemento del progreso
    "/dashboard/obras/usuarios-asignados/carga/" + $("#id").val(), // URL datos
    [
      { data: "name",       name:"users.name",  width: "50%"},
      { data: "rol",        name:"r.nombre",    width: "35%"},
      { data: "acciones",                       width: "15%",   searchable: false,  orderable: false},
    ], // Columnas
  );
});

function asignarUsuario(){
  _mostrarFormulario("/dashboard/obras/usuarios-asignados/create/" + $("#id").val(), //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#name", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $("#_usuario_id").select2();
                      }, //Funcion para el success
                      "#form-obras-asignar-usuario", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-crear", function(){
            							_recargarTabla("#dt-usuarios-asignados");
            						});
                      });//Funcion en caso de guardar correctamente);
}

function eliminarUsuarioAsignado(id){
  _mostrarFormulario("/dashboard/obras/usuarios-asignados/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-eliminar-usuario-asignado", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-usuarios-asignados");
            						});
                      });//Funcion en caso de guardar correctamente);
}