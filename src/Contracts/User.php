<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:26.
 */

namespace HughCube\Laravel\OAuthStorage\Contracts;

use Carbon\Carbon;

interface User
{
    /**
     * @return string
     */
    public function getAppid(): ?string;

    /**
     * @return string
     */
    public function getAppType(): ?string;

    /**
     * @return string
     */
    public function getService(): ?string;

    /**
     * @return string
     */
    public function getUserType(): ?string;

    /**
     * @return string
     */
    public function getUserId(): ?string;

    /**
     * @return string
     */
    public function getOpenId(): ?string;

    /**
     * @return string
     */
    public function getSubOpenId(): ?string;

    /**
     * @return null|Carbon
     */
    public function getDeletedAt(): ?Carbon;

    /**
     * @return null|Carbon
     */
    public function getCreatedAt(): ?Carbon;

    /**
     * @return null|Carbon
     */
    public function getUpdatedAt(): ?Carbon;

    /**
     * @return array
     */
    public function getExtras(): array;


    /**
     * @param  string  $appId
     * @return $this
     */
    public function setAppid(string $appId): User;

    /**
     * @param  string  $appType
     * @return $this
     */
    public function setAppType(string $appType): User;

    /**
     * @param  string  $service
     * @return $this
     */
    public function setService(string $service): User;

    /**
     * @param  string  $userType
     * @return $this
     */
    public function setUserType(string $userType): User;

    /**
     * @param  string  $userId
     * @return $this
     */
    public function setUserId(string $userId): User;

    /**
     * @param  string  $openId
     * @return $this
     */
    public function setOpenId(string $openId): User;

    /**
     * @param  string  $subOpenId
     * @return $this
     */
    public function setSubOpenId(string $subOpenId): User;

    /**
     * @param  array  $extras
     * @return $this
     */
    public function setExtras(array $extras): User;

    /**
     * @return int|null
     */
    public function getWeChatSubscribe(): ?int;

    /**
     * @return string|null
     */
    public function getWeChatOpenid(): ?string;

    /**
     * @return string|null
     */
    public function getWeChatLanguage(): ?string;

    /**
     * @return int|null
     */
    public function getWeChatSubscribeTime(): ?int;

    /**
     * @return string|null
     */
    public function getWeChatUnionid(): ?string;

    /**
     * @return int|null
     */
    public function getWeChatGroupId(): ?int;

    /**
     * @return array|null
     */
    public function getWeChatTagidList(): ?array;

    /**
     * @return string|null
     */
    public function getWeChatSubscribeScene(): ?string;

    /**
     * @return int|null
     */
    public function getWeChatQrScene(): ?int;

    /**
     * @return string|null
     */
    public function getWeChatQrSceneStr(): ?string;

    /**
     * @param  integer  $state
     * @return User
     */
    public function setTokenState(int $state): User;

    /**
     * @return int|null
     */
    public function getTokenState(): ?int;
}
