<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:02.
 */

namespace HughCube\Laravel\OAuthStorage\Contracts;

interface Client
{
    /**
     * find user.
     */
    public function findByUser(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $userid
    ): ?array;

    /**
     * find openid.
     */
    public function findByOpenId(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $openid,
        string $subOpenid = ''
    ): ?array;

    /**
     * delete user.
     */
    public function deleteByUser(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $userid
    );

    /**
     * delete openid.
     */
    public function deleteByOpenId(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $openid,
        string $subOpenid = ''
    );

    /**
     * save.
     */
    public function create(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $userid,
        string $openid,
        string $subOpenid = '',
        array $extras = []
    );

    /**
     * save.
     */
    public function createByUser(User $user);

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
    );

    /**
     * proxy.
     */
    public function makeProxy(
        string $appid,
        string $apptype,
        string $service,
        string $usertype
    ): Proxy;
}
