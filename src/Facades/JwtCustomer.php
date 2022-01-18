<?php
namespace StrongNguyen\JwtAuthService\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class JwtCustomer
 * @package StrongNguyen\JwtAuthService\Facades
 *
 * @method static bool isValid()
 * @method static object|null getData()
 * @method static string|null getFrom()
 * @method static string|null getAppCode()
 * @method static int|null getUserId()
 * @method static string|null getGroupCode()
 * @method static string|null getCompanyCode()
 * @method static int getUserCoefficient()
 * @method static string createCustomerToken($appCode, $groupCode, $customerCode, $userId = 1, $hs = 100)
 *
 * @see \StrongNguyen\JwtAuthService\JwtCustomerManager
 */
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