<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:17.
 */

namespace HughCube\Laravel\OAuthStorage\Kernel;

use HughCube\Laravel\OAuthStorage\Contracts\Proxy;
use HughCube\Laravel\OAuthStorage\Contracts\User as UserContract;
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

    /**
     * save.
     */
    public function newUser(
        string $appid = null,
        string $apptype = null,
        string $service = null,
        string $usertype = null,
        string $userid = null,
        string $openid = null,
        string $subOpenid = '',
        array $extras = []
    ) {
        $user = new User();

        return $user->setAppid($appid)
            ->setAppType($apptype)
            ->setService($service)
            ->setUserType($usertype)
            ->setUserId($userid)
            ->setOpenId($openid)
            ->setSubOpenId($openid);
    }

    public function createByUser(UserContract $user)
    {
        $this->create(
            $user->getAppid(),
            $user->getAppType(),
            $user->getService(),
            $user->getUserType(),
            $user->getUserId(),
            $user->getOpenId(),
            ($user->getSubOpenId() ?: ''),
            $user->getExtras()
        );
    }
}
