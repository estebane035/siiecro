<?php 


namespace App\Clases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use Auth;
use Respuesta;
use Response;

class Cadenas{
	public static function obtenerSiglasDeCadena($cadena){
		$palabras 		= 	explode(" ", $cadena);
		$siglas 		= 	"";

		foreach ($palabras as $p) {
			$siglas 		.= 	$p[0];
		}

		return $siglas;
	}
}

?>