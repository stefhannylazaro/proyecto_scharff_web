<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdmin
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
        if ( $usuario->rol == 'superadmin'){
          return $next($request);

        }else if($usuario->rol == 'usuario'){
          return redirect()->route('ad.index');
        }
        //

    }
}
