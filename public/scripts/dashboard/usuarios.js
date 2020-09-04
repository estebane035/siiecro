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