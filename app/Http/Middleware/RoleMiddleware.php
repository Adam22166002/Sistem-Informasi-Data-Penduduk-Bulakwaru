<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            abort(403, 'Akses ditolak.');
        }
        if ($request->is('register') || $request->is('register/*')) {
            abort(404,'Akses Register dimatikan, Hubungi Admin!');
        }
        return $next($request);
    }
}
