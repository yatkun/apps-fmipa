<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Iku
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('authenticated_application') !== 'IKU') {
            return redirect()->route('apps'); // Redirect ke halaman utama jika aplikasi tidak dipilih
        }

        return $next($request);
    }
}
