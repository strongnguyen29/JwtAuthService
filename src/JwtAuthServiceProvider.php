<?php

namespace StrongNguyen\JwtAuthService;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use stdClass;

class JwtAuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/jwt-auth-service.php', 'jwt-auth-service');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/jwt-auth-service.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'jwt-auth-service.php',
            'jwt-auth-service'
        ]);

        Auth::viaRequest('customer', function (Request $request) {

            if ($token = $request->bearerToken()) {
                $publicKey = config('jwt-auth-service.customer_secret_key');
                if (!$publicKey) return null;

                $data = JWT::decode($token, new Key($publicKey, 'RS256'));
                $user = new stdClass();
                $user->id = $data->user_id;
                $user->appCode = $data->app_code ?? null;
                $user->groupCode = $data->company_group_code ?? null;
                $user->companyCode = $data->company_code ?? null;
                $user->companyId = $data->company_id ?? null;
                $user->userCoefficient = $data->user_coefficient ?? 100;
                return $user;
            }

            return null;
        });

        Auth::viaRequest('admin', function (Request $request) {

            if ($token = $request->bearerToken()) {
                $key = config('jwt-auth-service.admin_secret_key');
                if (!$key) return null;

                $data = JWT::decode($token, $key, array('HS256'));
                $user = new stdClass();
                $user->id = $data->id;
                $user->appCode = $data->app_code ?? null;
                $user->username = $data->username ?? null;
                return $user;
            }
            return null;
        });
    }
}