<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

################ RUTAS DEL DASHBOARD ####################################
# 	Todos los controladores van dentro de la carpeta Dashboard 			#
#	Todas las rutas tendran el prefijo dashboard 						#
#	Todas las rutas tendran el prefijo dashboard. en sus names 			#
#########################################################################

Route::prefix('dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {
    ######## DASHBOARD ##############################################################
		Route::get('/', 	'DashboardController@index')->name('dashboard.index');
	#################################################################################

    ######## USUARIOS ###############################################################
		Route::get('usuarios/carga', 			'UsuariosController@cargarTabla');
		Route::get('usuarios/{id}/eliminar', 	'UsuariosController@eliminar');
		Route::resource('usuarios', 			'UsuariosController');
	#################################################################################

    ######## Areas ###############################################################
		Route::get('areas/carga', 			'AreasController@cargarTabla');
		Route::get('areas/{id}/eliminar', 	'AreasController@eliminar');
		Route::resource('areas', 			'AreasController');
	#################################################################################

    ######## Proyectos ###############################################################
		Route::get('proyectos/carga', 			'ProyectosController@cargarTabla');
		Route::get('proyectos/{id}/eliminar', 	'ProyectosController@eliminar');
		Route::resource('proyectos', 			'ProyectosController');
	#################################################################################

    ######## ROLES ##################################################################
		Route::get('roles/carga', 			'RolesController@cargarTabla');
		Route::get('roles/{id}/eliminar', 	'RolesController@eliminar');
		Route::resource('roles', 			'RolesController');
	#################################################################################

    ######## OBRAS ##################################################################
		Route::get('obras/carga', 								'ObrasController@cargarTabla');
		Route::get('obras/solicitudes-intervencion', 			'ObrasController@solicitudesIntervencion')->name('obras.solicitudes');
		Route::get('obras/solicitudes-intervencion/carga', 		'ObrasController@cargarSolicitudesIntervencion');
		Route::get('obras/{id}/eliminar', 						'ObrasController@eliminar');
		Route::get('obras/{id}/aprobar', 						'ObrasController@modalAprobar');
		Route::put('obras/{id}/aprobar', 						'ObrasController@aprobar')->name('obras.aprobar');
		Route::get('obras/{id}/rechazar', 						'ObrasController@modalRechazar');
		Route::put('obras/{id}/rechazar', 						'ObrasController@rechazar')->name('obras.rechazar');
		Route::resource('obras', 								'ObrasController');

		###### OBRAS USUARIOS ASIGNADOS #############################################
			Route::get('obras/usuarios-asignados/carga/{obra_id}', 	'ObrasUsuariosAsignadosController@cargarTabla');
			Route::get('obras/usuarios-asignados/{id}/eliminar', 	'ObrasUsuariosAsignadosController@eliminar');
			Route::get('obras/usuarios-asignados/create/{obra_id}', 'ObrasUsuariosAsignadosController@create');
			Route::resource('obras/usuarios-asignados', 			'ObrasUsuariosAsignadosController');
		#############################################################################

	#################################################################################
    
    ######## OBRAS DETALLE SOLICITUD ANALISIS #######################################
		Route::get('solicitudes-analisis/carga/{id}', 									'ObrasSolicitudesAnalisisController@cargarTabla');
		Route::get('solicitudes-analisis/create/{id}', 									'ObrasSolicitudesAnalisisController@create')->name('solicitudes-analisis.create');
		Route::get('solicitudes-analisis/{id}/eliminar', 								'ObrasSolicitudesAnalisisController@eliminar');
		Route::get('solicitudes-analisis/{id}/aprobar-solicitud-analisis', 				'ObrasSolicitudesAnalisisController@modalAprobarSolicitudAnalisis');
		Route::put('solicitudes-analisis/{id}/aprobar-solicitud-analisis', 				'ObrasSolicitudesAnalisisController@aprobarSolicitudAnalisis')->name('obras.aprobar-solicitud-analisis');
		Route::get('solicitudes-analisis/{id}/rechazar-solicitud-analisis', 			'ObrasSolicitudesAnalisisController@modalRechazarSolicitudAnalisis');
		Route::put('solicitudes-analisis/{id}/rechazar-solicitud-analisis', 			'ObrasSolicitudesAnalisisController@rechazarSolicitudAnalisis')->name('obras.rechazar-solicitud-analisis');
		Route::get('solicitudes-analisis/{id}/poner-en-revision-solicitud-analisis', 	'ObrasSolicitudesAnalisisController@modalEnRevisionSolicitudAnalisis');
		Route::put('solicitudes-analisis/{id}/poner-en-revision-solicitud-analisis', 	'ObrasSolicitudesAnalisisController@enRevisionSolicitudAnalisis')->name('obras.poner-en-revision-solicitud-analisis');
		Route::post('solicitudes-analisis/{id}/subir-esquema', 							'ObrasSolicitudesAnalisisController@subirImagenEsquema');
		Route::get('solicitudes-analisis/{id}/eliminar-esquema', 						'ObrasSolicitudesAnalisisController@alertaEliminarEsquema');
		Route::delete('solicitudes-analisis/{id}/eliminar-esquema', 					'ObrasSolicitudesAnalisisController@eliminaresquema')->name('obras.eliminar-esquema-solicitud-analisis');
		Route::get('solicitudes-analisis/{id}/ver-esquema', 							'ObrasSolicitudesAnalisisController@verEsquema');
		
		Route::get('solicitudes-analisis/ver-muestras/{id}', 							'ObrasSolicitudesAnalisisController@verMuestras');
		Route::get('solicitudes-analisis/cargar-muestras/{id}', 						'ObrasSolicitudesAnalisisController@cargarMuestras');
		Route::get('solicitudes-analisis/crear-muestra', 								'ObrasSolicitudesAnalisisController@crearMuestra');
		Route::post('solicitudes-analisis/guardar-muestra', 							'ObrasSolicitudesAnalisisController@guardarMuestra')->name('solicitudes-analisis.guardar-muestra');
		Route::get('solicitudes-analisis/editar-muestra/{id}', 							'ObrasSolicitudesAnalisisController@editarMuestra');
		Route::put('solicitudes-analisis/actualizar-muestra/{id}', 						'ObrasSolicitudesAnalisisController@actualizarMuestra')->name('solicitudes-analisis.actualizar-muestra');
		Route::get('solicitudes-analisis/aviso-eliminar-muestra/{id}', 					'ObrasSolicitudesAnalisisController@avisoEliminarMuestra');
		Route::delete('solicitudes-analisis/destruir-muestra/{id}', 					'ObrasSolicitudesAnalisisController@destruirMuestra')->name('solicitudes-analisis.destruir-muestra');
		
		Route::resource('solicitudes-analisis', 						'ObrasSolicitudesAnalisisController');
	#################################################################################
    
    ######## OBRAS TIPO BIEN CULTURAL ###############################################
		Route::get('obras-tipo-bien-cultural/carga', 			'ObrasTipoBienCulturalController@cargarTabla');
		Route::get('obras-tipo-bien-cultural/{id}/eliminar', 	'ObrasTipoBienCulturalController@eliminar');
		Route::resource('obras-tipo-bien-cultural', 			'ObrasTipoBienCulturalController');
	#################################################################################

    ######## OBRAS TIPO OBJETO ######################################################
		Route::get('obras-tipo-objeto/carga', 					'ObrasTipoObjetoController@cargarTabla');
		Route::get('obras-tipo-objeto/{id}/eliminar', 			'ObrasTipoObjetoController@eliminar');
		Route::resource('obras-tipo-objeto', 					'ObrasTipoObjetoController');
	#################################################################################

    ######## OBRAS EPOCA ############################################################
		Route::get('obras-epoca/carga', 						'ObrasEpocaController@cargarTabla');
		Route::get('obras-epoca/{id}/eliminar', 				'ObrasEpocaController@eliminar');
		Route::resource('obras-epoca', 							'ObrasEpocaController');
	#################################################################################

    ######## OBRAS TEMPORALIDAD #####################################################
		Route::get('obras-temporalidad/carga', 					'ObrasTemporalidadController@cargarTabla');
		Route::get('obras-temporalidad/{id}/eliminar', 			'ObrasTemporalidadController@eliminar');
		Route::resource('obras-temporalidad', 					'ObrasTemporalidadController');
	#################################################################################

});

#########################################################################
# 						FIN RUTAS DASHBOARD 							#
#########################################################################

