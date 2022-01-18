<?php

namespace StrongNguyen\JwtAuthService\Http\Middleware;

use Closure;
use StrongNguyen\JwtAuthService\Facades\JwtCustomer;
use StrongNguyen\JwtAuthService\Facades\JwtAdmin;


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
            if ($role == 'admin' && JwtAdmin::isValid()) {
                return $next($request);
            } elseif ($role == 'customer' && JwtCustomer::isValid()) {
                return $next($request);
            }
        }

        abort(403, 'Không có quyền truy cập!');
    }
}
