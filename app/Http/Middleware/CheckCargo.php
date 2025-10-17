<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckCargo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$cargosPermitidos)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuário não autenticado'
            ], 401);
        }


        if (!in_array(Auth::user()->cargo, $cargosPermitidos)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Acesso negado'
            ], 403);
        }


        return $next($request);
    }

}
