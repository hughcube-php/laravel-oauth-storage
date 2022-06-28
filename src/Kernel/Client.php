<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:17.
 */

namespace HughCube\Laravel\OAuthStorage\Kernel;

use HughCube\Laravel\OAuthStorage\Contracts\Proxy;
use HughCube\Laravel\OAuthStorage\Kernel\Proxy as KernelProxy;

abstract class Client implements \HughCube\Laravel\OAuthStorage\Contracts\Client
{
    /**
     * @inheritDoc
     */
    public function makeProxy(string $appid, string $apptype, string $service, string $usertype): Proxy
    {
        return new KernelProxy($appid, $apptype, $service, $usertype, $this);
    }
}
