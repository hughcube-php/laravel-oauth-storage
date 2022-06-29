<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:03.
 */

namespace HughCube\Laravel\OAuthStorage\Kernel;

use Carbon\Carbon;
use HughCube\Laravel\OAuthStorage\Contracts\User as UserContract;

class User implements UserContract
{
    protected $attributes = [];

    protected $tokenState;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * @inheritDoc
     */
    public function getAppid(): ?string
    {
        return $this->attributes['appid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getAppType(): ?string
    {
        return $this->attributes['apptype'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getService(): ?string
    {
        return $this->attributes['service'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getUserType(): ?string
    {
        return $this->attributes['usertype'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getUserId(): ?string
    {
        return $this->attributes['userid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getOpenId(): ?string
    {
        return $this->attributes['openid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getSubOpenId(): ?string
    {
        return $this->attributes['sub_openid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getDeletedAt(): ?Carbon
    {
        $date = $this->attributes['deleted_at'] ?? null;

        return empty($date) ? null : Carbon::parse($date);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?Carbon
    {
        $date = $this->attributes['created_at'] ?? null;

        return empty($date) ? null : Carbon::parse($date);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?Carbon
    {
        $date = $this->attributes['updated_at'] ?? null;

        return empty($date) ? null : Carbon::parse($date);
    }

    /**
     * @inheritDoc
     */
    public function getExtras(): array
    {
        $extras = $this->attributes['extras'] ?? null;
        if (empty($extras)) {
            return [];
        }

        $items = json_decode($extras, true);

        return is_array($items) ? $items : [];
    }

    /**
     * @inheritDoc
     */
    public function getWeChatSubscribe(): ?int
    {
        return $this->getExtras()['subscribe'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatOpenid(): ?string
    {
        return $this->getExtras()['openid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatLanguage(): ?string
    {
        return $this->getExtras()['language'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatSubscribeTime(): ?int
    {
        return $this->getExtras()['subscribe_time'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatUnionid(): ?string
    {
        return $this->getExtras()['unionid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatGroupId(): ?int
    {
        return $this->getExtras()['groupid'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatTagidList(): ?array
    {
        return $this->getExtras()['tagid_list'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatSubscribeScene(): ?string
    {
        return $this->getExtras()['subscribe_scene'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatQrScene(): ?int
    {
        return $this->getExtras()['qr_scene'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWeChatQrSceneStr(): ?string
    {
        return $this->getExtras()['qr_scene_str'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setAppid(string $appId): UserContract
    {
        $this->attributes['appid'] = $appId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAppType(string $appType): UserContract
    {
        $this->attributes['apptype'] = $appType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setService(string $service): UserContract
    {
        $this->attributes['service'] = $service;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUserType(string $userType): UserContract
    {
        $this->attributes['usertype'] = $userType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUserId(string $userId): UserContract
    {
        $this->attributes['userid'] = $userId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOpenId(string $openId): UserContract
    {
        $this->attributes['openid'] = $openId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSubOpenId(string $subOpenId): UserContract
    {
        $this->attributes['sub_openid'] = $subOpenId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setExtras(array $extras): UserContract
    {
        $this->attributes['extras'] = $extras;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTokenState(int $state): UserContract
    {
        $this->tokenState = $state;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTokenState(): ?int
    {
        return $this->tokenState;
    }
}
