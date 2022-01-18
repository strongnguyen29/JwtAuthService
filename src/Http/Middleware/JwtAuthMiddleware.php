<?php

namespace StrongNguyen\JwtAuthService\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Log;
use StrongNguyen\JwtAuthService\Facades\JwtCustomer;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->bearerToken()) {
            switch($role) {
                case 'admin':
                    if (JwtAdmin::isValid()) return $next($request);
                    break;
                case 'customer':
                    if (JwtCustomer::isValid()) return $next($request);
                    break;
            }
        }

        abort(403, 'Không có quyền truy cập!');
    }
}
