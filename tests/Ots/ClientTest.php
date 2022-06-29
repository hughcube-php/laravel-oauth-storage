<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 21:51.
 */

namespace HughCube\Laravel\OAuthStorage\Tests\Ots;

use Aliyun\OTS\OTSServerException;
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
            $this->getClient()->create(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString(),
                [
                    'subscribe'       => 1,
                    'openid'          => $wxOpenid = 'o6_bmjrPTlm6_2sgVt7hMZOPfL2M',
                    'language'        => 'zh_CN',
                    'subscribe_time'  => 1382694957,
                    'unionid'         => ' o6_bmasdasdsad6_2sgVt7hMZOPfL',
                    'remark'          => '',
                    'groupid'         => 0,
                    'tagid_list'      => [128, 2],
                    'subscribe_scene' => 'ADD_SCENE_QR_CODE',
                    'qr_scene'        => 98765,
                    'qr_scene_str'    => '',
                ]
            );

            $this->assertSame(
                $userid,
                $this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid)['userid']
            );

            $user = $this->getClient()
                ->makeProxy($appid, $apptype, $service, $usertype)
                ->findByUser($userid);
            $this->assertSame($wxOpenid, $user->getWeChatOpenid());
        });
    }

    public function testFindByOpenId()
    {
        $this->assertNoException(function () {
            $this->getClient()->create(
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
            $this->getClient()->create(
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
            $this->getClient()->create(
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
            $this->getClient()->create(
                $appid = $this->randomString(),
                $apptype = $this->randomString(),
                $service = $this->randomString(),
                $usertype = $this->randomString(),
                $userid = $this->randomString(),
                $openid = $this->randomString(),
                $subOpenid = $this->randomString(),
                $attributes = ['test1' => 'test1', 'test2' => 1, 'test3' => false, 'test5' => 1.09]
            );

            $exception = null;

            try {
                $this->getClient()->create($appid, $apptype, $service, $usertype, $userid, $openid, $subOpenid);
            } catch (OTSServerException $exception) {
            }
            $this->assertInstanceOf(OTSServerException::class, $exception);

            $this->assertArrayHasKey(
                'appid',
                $this->getClient()->findByUser($appid, $apptype, $service, $usertype, $userid)
            );
        });
    }
}
