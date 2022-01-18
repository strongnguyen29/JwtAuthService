<?php
namespace StrongNguyen\JwtAuthService\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class JwtAdmin
 * @package StrongNguyen\JwtAuthService\Facades
 *
 * @method static bool isValid()
 * @method static object|null getData()
 * @method static string|null getFrom()
 * @method static string|null getAppCode()
 * @method static int|null getUserId()
 * @method static string|null getUsername()
 * @method static string createAdminToken($appCode = 'hl_cms', $userId = 1, $username = 'admin')
 *
 * @see \StrongNguyen\JwtAuthService\JwtAdminManager
 */
class JwtAdmin extends Facade
{
    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jwt-auth-admin';
    }
}