<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validar_perfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->perfil != 'admin')
        abort(code:'403',message:'Acceso no autorizado!');

        return $next($request);
    }
}
