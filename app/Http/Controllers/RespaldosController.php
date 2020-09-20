<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\File;


class RespaldosController extends Controller
{
    public $process = NULL;

    public function realizarTransferenciaClouds(Request $request)
    {
        $carpeta = '/siiecro-respaldos';

        try {
        	// crea el respaldo del sistema y la bd
            Artisan::call('backup:run');
        } catch (\Throwable $th) {
            echo ($th);
            
            if($request->ajax()){
                return "No se pudo realizar el respaldo de la base de datos ".$th;
            }
        }

        // Obtiene todos los archivos de la carpeta de respaldos locales
        $archivos_locales = Storage::disk('local')->files($carpeta);
        // Verifica si fueron encontrados los archivos de respaldos locales para enviarlos a drive
        if (count($archivos_locales)>0) {
            foreach($archivos_locales as $ruta_archivo){
            	// obtiene el nombre del archivo quitando el nombre de la carpeta
                $nombre_archivo = substr($ruta_archivo, -23);

                $ruta_archivo 	= str_replace('/', '\\', $ruta_archivo);
                $file_content 	= Storage::disk('local')->get($ruta_archivo);
                Storage::disk('google')->put( $nombre_archivo, $file_content);

                // se deja lo siguiente comentado en caso de necesitarse más adelante configuración para envío por ftp
                // // Verifica que el archivo no exista para no hacer duplicado de archivos_locales, utilizando el driver ftp 
                // if( ! Storage::disk('ftp')->exists($nombre_archivo)) {
                //     // parametros del storage disk put (como se llamará el archivo, donde se encuentra este, visibilidad)
                //     // Se envían los archivos_locales por ftp
                //     Storage::disk('ftp')->put( $nombre_archivo, $file_content);
                // }
                Storage::disk('local')->delete($ruta_archivo);
            }

        }
    }

    public function eliminarArchivosDeDrive()
    {
        // Obtiene todos los archivos de la carpeta de respaldos del drive
        $archivos_en_drive   = Storage::disk('google')->files();
        // Verifica si fueron encontrados los archivos de respaldos en drive para borrarlos uno por uno
    	if (count($archivos_en_drive) > 0){
            foreach($archivos_en_drive as $archivo){
            	Storage::disk('google')->delete($archivo);
            }
    	}
    }
}
