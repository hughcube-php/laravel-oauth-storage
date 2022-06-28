<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:45 下午.
 */

namespace HughCube\Laravel\OAuthStorage\Tests;

use HughCube\Laravel\OAuthStorage\Manager;
use HughCube\Laravel\OAuthStorage\OAuthStorage;

class FacadeTest extends TestCase
{
    public function testIsFacade()
    {
        $this->assertInstanceOf(Manager::class, OAuthStorage::getFacadeRoot());
    }
}
