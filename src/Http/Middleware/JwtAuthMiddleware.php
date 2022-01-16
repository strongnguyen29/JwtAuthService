<?php

namespace StrongNguyen\JwtAuthService\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Log;

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
        if ($token = request()->bearerToken()) {
            $keyName = $role == 'admin' ? 'admin_secret_key' : 'customer_secret_key';
            $key = config('jwt-auth-service.' . $keyName);

            if (!$key) {
                abort(500, "Chưa thiết lập {$keyName}");
            }

            try {
                JWT::decode($token, $key, array('HS256'));
                return $next($request);
            } catch (\Throwable $e) {
                Log::error(self::class . '@handle: ' .$e->getMessage());
            }
        }

        abort(403, 'Không có quyền truy cập!');
    }
}
