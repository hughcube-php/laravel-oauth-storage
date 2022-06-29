<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:18.
 */

namespace HughCube\Laravel\OAuthStorage\Kernel;

use HughCube\Laravel\OAuthStorage\Contracts\Client as ClientContract;
use HughCube\Laravel\OAuthStorage\Contracts\User as UserContract;

class Proxy implements \HughCube\Laravel\OAuthStorage\Contracts\Proxy
{
    protected $appid;

    protected $apptype;

    protected $service;

    protected $usertype;

    protected $client;

    public function __construct(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        ClientContract $client
    ) {
        $this->appid = $appid;
        $this->apptype = $apptype;
        $this->service = $service;
        $this->usertype = $usertype;
        $this->client = $client;
    }

    public function findByUser(string $userid): ?UserContract
    {
        return $this->toUser($this->client->findByUser(
            $this->appid,
            $this->apptype,
            $this->service,
            $this->usertype,
            $userid
        ));
    }

    public function findByOpenId(string $openid, string $subOpenid = ''): ?UserContract
    {
        return $this->toUser($this->client->findByOpenId(
            $this->appid,
            $this->apptype,
            $this->service,
            $this->usertype,
            $openid,
            $subOpenid
        ));
    }

    public function deleteByUser(string $userid): ?UserContract
    {
        return $this->client->deleteByUser(
            $this->appid,
            $this->apptype,
            $this->service,
            $this->usertype,
            $userid
        );
    }

    public function deleteByOpenId(string $openid, string $subOpenid = '')
    {
        $this->client->findByOpenId(
            $this->appid,
            $this->apptype,
            $this->service,
            $this->usertype,
            $openid,
            $subOpenid
        );
    }

    public function create(string $userid, string $openid, string $subOpenid = '', array $extras = [])
    {
        $this->client->create(
            $this->appid,
            $this->apptype,
            $this->service,
            $this->usertype,
            $userid,
            $openid,
            $subOpenid,
            $extras
        );
    }

    public function newUser(
        string $userid = null,
        string $openid = null,
        string $subOpenid = '',
        array $extras = []
    ): UserContract {
        return $this->client->newUser(
            $this->appid,
            $this->apptype,
            $this->service,
            $this->usertype,
            $userid,
            $openid,
            $subOpenid,
            $extras
        );
    }

    protected function toUser(?array $attributes): ?User
    {
        if (empty($attributes)) {
            return null;
        }
        return new User($attributes);
    }
}
