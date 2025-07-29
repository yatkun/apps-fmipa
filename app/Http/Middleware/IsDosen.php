<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsDosen
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'Dosen') {
            return $next($request);
        }

        abort(403, 'Hanya Dosen yang bisa mengakses halaman ini.');
    }
}
