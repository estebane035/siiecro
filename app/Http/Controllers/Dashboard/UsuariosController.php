<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\User;

class UsuariosController extends Controller
{
    public function index(){
    	$titulo 		= 	"Usuarios";
    	
    	return view("dashboard.usuarios.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	User::all();

    	return DataTables::of($registros)
    					->addColumn('acciones', function($registro){
    						return "Acciones";
    					})
    					->make('true');
    }
}
