<?php

namespace App\Http\Middleware;

use App\Models\Accion;
use App\Models\PerfilAccion;
use Closure;

class PermisoPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario = auth()->user();
        $perfil = $usuario->administrator->perfil_id;

        $uri = $request->getRequestUri();
        $uri = str_replace('/superadmin', '',$uri);
        $uri = trim(str_replace('/', ' ', $uri));
        $base_ruta = explode(' ', $uri)[0];
        $base_ruta = strtok($base_ruta, '?');
        $permiso = PerfilAccion::join('accion','accion.id','=','perfil_accion.accion_id')
            ->where('accion.base_ruta', $base_ruta )
            ->where('perfil_accion.perfil_id', $perfil)->where('perfil_accion.estado', 1)->first();


        if ( $permiso){

            return $next($request);
        }
        return $next($request);

        $accion = Accion::where('base_ruta', $base_ruta )->first();

        if ($accion){
            $nombre = $accion->nombre;

            return response()->view('admin.layout.permiso', compact('nombre'));
        } else{
            $permiso  = PerfilAccion::join('accion','accion.id','=','perfil_accion.accion_id')
                ->where('perfil_accion.perfil_id', $perfil)
                ->where('perfil_accion.estado', 1)->first();

            if ($permiso) {
                return redirect()->route('adm.'. $permiso->base_ruta . '.index');
            }else{
                return response()->view('admin.layout.permiso-general');
            }
        }

    }
}
