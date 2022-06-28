<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/18
 * Time: 10:31 下午.
 */

namespace HughCube\Laravel\OAuthStorage;

use HughCube\Laravel\OAuthStorage\Contracts\Client;
use HughCube\Laravel\OAuthStorage\Contracts\Proxy;
use HughCube\Laravel\ServiceSupport\LazyFacade;

/**
 * Class Package.
 *
 * @method static Client client(string $name = null)
 * @method static Proxy makeProxy(string $appid, string $apptype, string $service, string $usertype)
 *
 * @method static null|array findByUser(string $appid, string $apptype, string $service, string $usertype, string $userid)
 * @method static null|array findByOpenId($appid, $apptype, $service, $usertype, $openid, $subOpenid = '')
 * @method static null|array deleteByUser(string $appid, string $apptype, string $service, string $usertype, string $userid)
 * @method static null|array deleteByOpenId($appid, $apptype, $service, $usertype, $openid, $subOpenid = '')
 *
 * @see \HughCube\Laravel\OAuthStorage\Manager
 * @see \HughCube\Laravel\OAuthStorage\ServiceProvider
 */
class OAuthStorage extends LazyFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'oauthstorage';
    }

    /**
     * @inheritDoc
     */
    protected static function registerServiceProvider($app)
    {
        $app->register(ServiceProvider::class);
    }
}
