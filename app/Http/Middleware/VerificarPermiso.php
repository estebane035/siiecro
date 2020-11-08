<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;
use Illuminate\Http\Response as HTTPResponse;

class VerificarPermiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permisos)
    {
        $permisos           =   explode("|", $permisos);
        $puedeVer           =   false;

        foreach ($permisos as $permiso) {
            if(Auth::user()->rol->$permiso){ 
                $puedeVer   =   true;
            }
        }

        if(!$puedeVer){
            if($request->ajax()){
                return Response::json(["mensaje" => "No tienes permiso para realizar esta acción."], 500);
            } else{
                return new HTTPResponse(view('dashboard.sin-permiso'));
            }
        }

        return $next($request);
    }
}
