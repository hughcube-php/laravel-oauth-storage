<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:17.
 */

namespace HughCube\Laravel\OAuthStorage\Ots;

use Aliyun\OTS\Consts\ColumnTypeConst;
use Aliyun\OTS\Consts\DirectionConst;
use Aliyun\OTS\Consts\PrimaryKeyTypeConst;
use Aliyun\OTS\Consts\RowExistenceExpectationConst;
use Aliyun\OTS\OTSClientException;
use Aliyun\OTS\OTSServerException;
use Carbon\Carbon;
use HughCube\Laravel\OTS\Connection;
use HughCube\Laravel\OTS\Ots;

class Client extends \HughCube\Laravel\OAuthStorage\Kernel\Client
{
    /**
     * @var Connection
     */
    protected $connection;

    protected $table;

    protected $openidIndex;

    public function __construct(Connection $connection, string $table, string $openidIndex)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->openidIndex = $openidIndex;
    }

    /**
     * @inheritDoc
     *
     * @throws OTSClientException
     * @throws OTSServerException
     */
    public function findByUser(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $userid
    ): ?array {
        $response = $this->connection->getRow([
            'table_name' => $this->table,
            'primary_key' => [
                ['appid', strval($appid)],
                ['apptype', strval($apptype)],
                ['service', strval($service)],
                ['usertype', strval($usertype)],
                ['userid', strval($userid)],
            ],
            'max_versions' => 1,
        ]);

        return Ots::parseRow($response) ?: null;
    }

    /**
     * @inheritDoc
     *
     * @throws OTSClientException
     * @throws OTSServerException
     */
    public function findByOpenId(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $openid,
        string $subOpenid = ''
    ): ?array {
        $response = $this->connection->getRange([
            'table_name' => $this->openidIndex,
            'max_versions' => 1,
            'direction' => DirectionConst::CONST_BACKWARD,
            'inclusive_start_primary_key' => [
                ['appid', strval($appid)],
                ['apptype', strval($apptype)],
                ['service', strval($service)],
                ['usertype', strval($usertype)],
                ['openid', strval($openid)],
                ['sub_openid', strval($subOpenid ?: '')],
                ['userid', null, PrimaryKeyTypeConst::CONST_INF_MAX],
            ],
            'exclusive_end_primary_key' => [
                ['appid', strval($appid)],
                ['apptype', strval($apptype)],
                ['service', strval($service)],
                ['usertype', strval($usertype)],
                ['openid', strval($openid)],
                ['sub_openid', strval($subOpenid ?: '')],
                ['userid', null, PrimaryKeyTypeConst::CONST_INF_MIN],
            ],
            'limit' => 1,
        ]);

        foreach ($response['rows'] ?? [] as $row) {
            return Ots::parseRow($row) ?: null;
        }
        return null;
    }

    /**
     * @inheritDoc
     *
     * @throws OTSClientException
     * @throws OTSServerException
     */
    public function deleteByUser(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $userid
    ) {
        $response = $this->connection->deleteRow([
            'table_name' => $this->table,
            'condition' => RowExistenceExpectationConst::CONST_IGNORE,
            'primary_key' => [
                ['appid', strval($appid)],
                ['apptype', strval($apptype)],
                ['service', strval($service)],
                ['usertype', strval($usertype)],
                ['userid', strval($userid)],
            ],
        ]);

        if (!isset($response['primary_key'], $response['attribute_columns'])) {
            throw new OTSClientException('Delete failed!');
        }
    }

    /**
     * @inheritDoc
     *
     * @throws OTSClientException
     * @throws OTSServerException
     */
    public function deleteByOpenId(
        string $appid,
        string $apptype,
        string $service,
        string $usertype,
        string $openid,
        string $subOpenid = ''
    ) {
        $row = $this->findByOpenId($appid, $apptype, $service, $usertype, $openid, $subOpenid);
        if (empty($row)) {
            return true;
        }

        $this->deleteByUser($row['appid'], $row['apptype'], $row['service'], $row['usertype'], $row['userid']);
    }

    /**
     * @inheritDoc
     *
     * @throws OTSClientException
     * @throws OTSServerException
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
    ) {
        $now = Carbon::now();

        $response = $this->connection->putRow([
            'table_name' => $this->table,
            'condition' => RowExistenceExpectationConst::CONST_EXPECT_NOT_EXIST,
            'primary_key' => [
                ['appid', strval($appid)],
                ['apptype', strval($apptype)],
                ['service', strval($service)],
                ['usertype', strval($usertype)],
                ['userid', strval($userid)],
            ],
            'attribute_columns' => [
                ['openid', strval($openid), ColumnTypeConst::CONST_STRING],
                ['sub_openid', strval($subOpenid ?: ''), ColumnTypeConst::CONST_STRING],
                ['extras', json_encode($extras), ColumnTypeConst::CONST_STRING],
                ['deleted_at', '', ColumnTypeConst::CONST_STRING],
                ['created_at', $now->toRfc3339String(true), ColumnTypeConst::CONST_STRING],
                ['updated_at', $now->toRfc3339String(true), ColumnTypeConst::CONST_STRING],
            ]
        ]);

        if (!isset($response['primary_key'], $response['attribute_columns'])) {
            throw new OTSClientException('Save failed!');
        }
    }
}
