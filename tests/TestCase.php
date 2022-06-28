<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:36 下午.
 */

namespace HughCube\Laravel\OAuthStorage\Tests;

use HughCube\Laravel\OAuthStorage\OAuthStorage;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @inheritDoc
     */
    protected function getApplicationProviders($app): array
    {
        $providers = parent::getApplicationProviders($app);

        unset($providers[array_search(PasswordResetServiceProvider::class, $providers)]);

        return $providers;
    }

    /**
     * @param  Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            \HughCube\Laravel\OTS\ServiceProvider::class,
            \HughCube\Laravel\OAuthStorage\ServiceProvider::class,
        ];
    }

    /**
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $this->setupCache($app);

        /** @var Repository $appConfig */
        $appConfig = $app['config'];

        $appConfig->set(OAuthStorage::getFacadeAccessor(), [
            'default' => 'ots',

            /**
             * default config
             */
            'defaults' => [],

            'clients' => [
                'ots' => [
                    'driver' => 'ots',
                    'connection' => 'ots',
                    'table' => 'oauth_users',
                    'openid_index' => 'oauth_users_openid_index',
                ],
                'database' => [
                    'driver' => 'database',
                    'connection' => 'database',
                    'table' => 'oauth_users',
                ],
            ],
        ]);

        $appConfig->set('database', [
            'default' => env('DB_CONNECTION', 'ots'),
            'connections' => [
                'ots' => [
                    'driver' => 'ots',
                    'EndPoint' => env('OTS_ENDPOINT'),
                    'AccessKeyID' => env('OTS_ACCESS_KEY_ID'),
                    'AccessKeySecret' => env('OTS_ACCESS_KEY_SECRET'),
                    'InstanceName' => env('OTS_INSTANCE_NAME'),
                ],
            ],
            'migrations' => 'migrations',
        ]);
    }

    /**
     * @param  Application  $app
     */
    protected function setupCache(Application $app)
    {
        /** @var Repository $appConfig */
        $appConfig = $app['config'];

        $appConfig->set('cache', [
            'default' => 'default',
            'stores' => [
                'default' => [
                    'driver' => 'file',
                    'path' => sprintf('/tmp/test/%s', md5(serialize([__METHOD__]))),
                ],
            ],
        ]);
    }

    protected function randomString(): string
    {
        return sprintf('test_%s', Str::random(32));
    }

    protected function assertNoException(callable $callable)
    {
        $exception = null;
        try {
            $callable();
        } catch (\Throwable $exception) {
        }

        $this->assertNull($exception);
    }
}
