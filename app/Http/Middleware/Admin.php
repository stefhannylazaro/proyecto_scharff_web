<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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




        //return;
        if ( $usuario->rol == 'admin'||$usuario->rol == 'usuario'){
          return $next($request);
        }else if($usuario->rol == 'superadmin'){
          return redirect()->route('adm.index');
        }
        //return $next($request);
        //return redirect()->route('ad.index');
    }
}
