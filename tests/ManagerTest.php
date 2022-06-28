<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:45 下午.
 */

namespace HughCube\Laravel\OAuthStorage\Tests;

use HughCube\Laravel\OAuthStorage\Contracts\Client;
use HughCube\Laravel\OAuthStorage\Manager;
use HughCube\Laravel\OAuthStorage\OAuthStorage;

class ManagerTest extends TestCase
{
    public function testStore()
    {
        $manager = OAuthStorage::getFacadeRoot();

        $this->assertInstanceOf(Manager::class, $manager);
        $this->assertInstanceOf(Client::class, $manager->client());
    }
}
