<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 21:51
 */

namespace HughCube\Laravel\OAuthStorage\Tests\Ots;

use HughCube\Laravel\OAuthStorage\Contracts\Client;
use HughCube\Laravel\OAuthStorage\OAuthStorage;
use HughCube\Laravel\OAuthStorage\Tests\TestCase;

class ClientTest extends TestCase
{
    public function getClient(): Client
    {
        return OAuthStorage::client('ots');
    }

    public function testFindByUser()
    {
        $this->assertNoException(function () {
            $this->getClient()->save(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString()
            );

            $this->assertSame(
                $userid,
                $this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid)['userid']
            );
        });
    }

    public function testFindByOpenId()
    {
        $this->assertNoException(function () {
            $this->getClient()->save(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString()
            );

            $this->assertSame(
                $userid,
                $this->getClient()->findByOpenId($appid, $apptype, $service, $usertype, $openid, $subOpenid)['userid']
            );
        });
    }

    public function testDeleteByUser()
    {
        $this->assertNoException(function () {
            $this->getClient()->save(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString()
            );
            $this->assertArrayHasKey(
                'appid',
                $this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid)
            );

            $this->getClient()->deleteByUser($appid, $apptype, $service, $usertype, $userid);
            $this->assertNull($this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid));
        });
    }

    public function testDeleteByOpenId()
    {
        $this->assertNoException(function () {
            $this->getClient()->save(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString()
            );
            $this->assertArrayHasKey(
                'appid',
                $this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid)
            );

            $this->getClient()->deleteByOpenId($appid, $apptype, $service, $usertype, $openid, $subOpenid);
            $this->assertNull($this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid));
        });
    }

    public function testSave()
    {
        $this->assertNoException(function () {
            $this->getClient()->save(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString()
            );

            $this->assertArrayHasKey(
                'appid',
                $this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid)
            );
        });
    }
}
