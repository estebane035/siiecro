jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/usuarios/carga", // URL datos
			[
				{ data: "name", 		width: "30%"},
				{ data: "email", 		width: "30%"},
				{ data: "rol", 			width: "25%"},
				{ data: "acciones", 	width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(){
	_formularioEnModal	(
							"#modal-crear", // Nombre Modal 
							"#modal-1", // Contenedor modal
							"/dashboard/usuarios/create", // Ruta
							"#form-usuarios", // Formulario
							"#name", // Elemento focus
							"#div-notificacion", // Div Notificacion
							function(){
								_ocultarModal("#modal-crear", function(){
									_recargarTabla("#dt-datos");
								});
							} // Callback exito
						);
}