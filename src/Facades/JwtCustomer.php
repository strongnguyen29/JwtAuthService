<?php
namespace StrongNguyen\JwtAuthService\Facades;

use Illuminate\Support\Facades\Facade;

class JwtCustomer extends Facade
{
    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jwt-auth-customer';
    }
}