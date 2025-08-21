<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsTendik
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->level === 'Tendik' || (Auth::user()->level === 'Dosen' && Auth::user()->is_dekan))) {
            return $next($request);
        }

        abort(403, 'Hanya Tendik atau Dekan yang bisa mengakses halaman ini.');
    }
}