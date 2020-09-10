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

    ######## USUARIOS ###############################################################
		Route::get('areas/carga', 			'AreasController@cargarTabla');
		Route::get('areas/{id}/eliminar', 	'AreasController@eliminar');
		Route::resource('areas', 			'AreasController');
	#################################################################################
});

#########################################################################
# 						FIN RUTAS DASHBOARD 							#
#########################################################################

