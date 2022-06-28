<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:13
 */

namespace HughCube\Laravel\OAuthStorage\Contracts;

interface Proxy
{
    /**
     * find user
     */
    public function findByUser(string $userid): ?User;

    /**
     * find openid
     */
    public function findByOpenId(string $openid, string $subOpenid = ''): ?User;

    /**
     * find user
     */
    public function deleteByUser(string $userid);

    /**
     * find openid
     */
    public function deleteByOpenId(string $openid, string $subOpenid = '');

    /**
     * save
     */
    public function save(string $userid, string $openid, string $subOpenid = '');
}
