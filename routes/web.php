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
	#################################################################################
    
    ######## OBRAS DETALLE SOLICITUD ANALISIS #######################################
		Route::get('solicitudes-analisis/carga', 						'ObrasSolicitudesAnalisisController@cargarTabla');
		Route::get('solicitudes-analisis/{id}/eliminar', 				'ObrasSolicitudesAnalisisController@eliminar');
		
		Route::get('solicitudes-analisis/ver-muestras/{id}', 			'ObrasSolicitudesAnalisisController@verMuestras');
		Route::get('solicitudes-analisis/cargar-muestras/{id}', 		'ObrasSolicitudesAnalisisController@cargarMuestras');
		Route::get('solicitudes-analisis/crear-muestra', 				'ObrasSolicitudesAnalisisController@crearMuestra');
		Route::post('solicitudes-analisis/guardar-muestra', 			'ObrasSolicitudesAnalisisController@guardarMuestra')->name('solicitudes-analisis.guardar-muestra');
		Route::get('solicitudes-analisis/editar-muestra/{id}', 			'ObrasSolicitudesAnalisisController@editarMuestra');
		Route::put('solicitudes-analisis/actualizar-muestra/{id}', 		'ObrasSolicitudesAnalisisController@actualizarMuestra')->name('solicitudes-analisis.actualizar-muestra');
		Route::get('solicitudes-analisis/aviso-eliminar-muestra/{id}', 	'ObrasSolicitudesAnalisisController@avisoEliminarMuestra');
		Route::delete('solicitudes-analisis/destruir-muestra/{id}', 	'ObrasSolicitudesAnalisisController@destruirMuestra')->name('solicitudes-analisis.destruir-muestra');
		
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

    ######## OBRAS RESPONSABLES ECRO ################################################
		Route::get('obras-responsables-ecro/carga', 			'ObrasResponsablesEcroController@cargarTabla');
		Route::get('obras-responsables-ecro/{id}/eliminar', 	'ObrasResponsablesEcroController@eliminar');
		Route::resource('obras-responsables-ecro', 				'ObrasResponsablesEcroController');
	#################################################################################
});

#########################################################################
# 						FIN RUTAS DASHBOARD 							#
#########################################################################

