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

	public static function generarSeo($cadena, $id){
		$cadena 	= 	Self::urlAmigable($cadena)."-".$id;
		return $cadena;
	}

	public static function urlAmigable($string, $separator = '-')
	{
	    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
	    $special_cases = array( '&' => 'and', "'" => '');
	    $string = mb_strtolower( trim( $string ), 'UTF-8' );
	    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
	    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
	    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
	    $string = preg_replace("/[$separator]+/u", "$separator", $string);
	    return $string;
	}
}

?>