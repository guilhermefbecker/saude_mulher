<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MasterMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (!auth()->check()) {
            return redirect()->route('login');
        }


        if (!auth()->user()->is_master) {

            abort(403, 'Acesso permitido somente ao Admin Master.');
        }


        return $next($request);
    }
}