<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RrhhMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('usuario_rol') !== 'rrhh') {
            return redirect('/')->with('error', 'Acceso no autorizado.');
        }
        return $next($request);
    }
}
