<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:19 下午.
 */

namespace HughCube\Laravel\OAuthStorage;

use HughCube\Laravel\OAuthStorage\Contracts\Client;
use HughCube\Laravel\OAuthStorage\Ots\Client as OtsClient;
use HughCube\Laravel\ServiceSupport\Manager as ServiceSupportManager;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class Manager extends ServiceSupportManager
{
    protected function getPackageFacadeAccessor(): string
    {
        return OAuthStorage::getFacadeAccessor();
    }

    public function getDriversConfigKey(): string
    {
        return 'clients';
    }

    protected function makeDriver(array $config): Client
    {
        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($config['driver']);
        }

        $driverMethod = 'create'.ucfirst($config['driver']).'Client';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        }

        throw new InvalidArgumentException("Client [{$config['driver']}] is not supported.");
    }

    protected function createOtsClient(array $config): OtsClient
    {
        return new OtsClient(DB::connection($config['connection']), $config['table'], $config['openid_index']);
    }
}
