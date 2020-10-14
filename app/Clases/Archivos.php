<?php

namespace App\Clases;
use Illuminate\Http\Request;

use Session;
use Auth;
use Respuesta;
use Response;
use Image;
use File;

class Archivos
{
	public static function subirImagen($img, $nombre, $destino, $alto, $ancho = null){
        try {
            $imagen     =  Image::make($img->path());

            // Resize
            $imagen->resize($alto, $ancho, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Si no existe el directorio lo creamos
            if(!File::exists($destino)) {
                File::makeDirectory($destino, 0777, true, true);
            }

            $imagen->save($destino."/".$nombre);

            return "";
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
