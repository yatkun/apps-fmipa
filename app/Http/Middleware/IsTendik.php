<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsTendik
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'Tendik') {
            return $next($request);
        }

        abort(403, 'Hanya Tendik yang bisa mengakses halaman ini.');
    }
}