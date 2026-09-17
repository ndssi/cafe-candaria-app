<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Melindungi rute admin: kalau belum login (belum ada session admin_id),
     * paksa kembali ke halaman login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
