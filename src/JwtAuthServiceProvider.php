<?php

namespace StrongNguyen\JwtAuthService;


use Illuminate\Support\ServiceProvider;

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

        $this->app->singleton('jwt-auth-customer', function() {
            return new JwtCustomerManager();
        });

        $this->app->singleton('jwt-auth-admin', function() {
            return new JwtAdminManager();
        });
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
    }
}