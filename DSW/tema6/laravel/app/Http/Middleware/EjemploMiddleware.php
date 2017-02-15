<?php

namespace App\Http\Middleware;

use Closure;

class EjemploMiddleware
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
        // Aquí va toda la lógica
        return $next($request);
    }
}
