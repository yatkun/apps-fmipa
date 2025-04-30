<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthenticatedApplication
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('authenticated_application')) {
            return redirect()->route('apps'); // Redirect ke halaman utama jika aplikasi tidak dipilih
        }

        return $next($request);
    }
}
