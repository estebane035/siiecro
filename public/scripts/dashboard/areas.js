jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/areas/carga", // URL datos
			[
				{ data: "nombre", 		width: "45%"},
        { data: "siglas",     width: "20%"},
        { data: "campo",      width: "20%"},
				{ data: "acciones", 	width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(){
  _mostrarFormulario("/dashboard/areas/create", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#name", //Elemento al que se le dara focus una vez cargado el modal
                    function(){
                      $("#campo").select2();
                      $('#campo').on('select2:select', function (e) {
                        generarSiglas();
                      });
                    }, //Funcion para el success
                    "#form-areas", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-respuesta", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                        _ocultarModal("#modal-crear", function(){
            							_recargarTabla("#dt-datos");
            						});
                    });//Funcion en caso de guardar correctamente);
}

function editar(id)
{
    _mostrarFormulario("/dashboard/areas/"+id+"/edit/", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#name", //Elemento al que se le dara focus una vez cargado el modal
                    function(){
                      $("#campo").select2();
                      $('#campo').on('select2:select', function (e) {
                        generarSiglas();
                      });
                    }, //Funcion para el success
                    "#form-areas", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-respuesta", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                        _ocultarModal("#modal-crear", function(){
            							_recargarTabla("#dt-datos");
            						});
                    });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/dashboard/areas/"+id+"/eliminar/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-eliminar", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-areas", //ID del Formulario
                  "#carga-eliminar", //Loading de guardar datos de formulario
                  "#div-respuesta", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
        						_ocultarModal("#modal-eliminar", function(){
        							_recargarTabla("#dt-datos");
        						});
                  });//Funcion en caso de guardar correctamente);
}

function generarSiglas(){
  var nombre    =   $("#nombre").val();
  var campo     =   $("#campo").val();
  var siglas    =   "";

  if(campo != ""){
    campo       =   campo.normalize();
    partes      =   campo.split(" ");
    partes.forEach(function(palabra){
      if(palabra != ""){
        siglas  +=  palabra.charAt(0);
      }
    })
  }

  if(nombre != ""){
    nombre      =   nombre.normalize();
    partes      =   nombre.split(" ");
    partes.forEach(function(palabra){
      if(palabra != ""){
        siglas  +=  palabra.charAt(0);
      }
    })
  }

  siglas        =   siglas.toUpperCase();
  $("#siglas").val(siglas);
}