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
    /**
     * @var string
     */
    protected $appid;

    /**
     * @var string
     */
    protected $apptype;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $usertype;

    /**
     * @var string
     */
    protected $userid;

    /**
     * @var string
     */
    protected $openid;

    /**
     * @var string
     */
    protected $sub_openid;

    /**
     * @var string
     */
    protected $deleted_at;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $updated_at;

    public function __construct($attributes = [])
    {
    }

    /**
     * @return string
     */
    public function getAppid(): string
    {
        return $this->appid;
    }

    /**
     * @return string
     */
    public function getAppType(): string
    {
        return $this->apptype;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->usertype;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userid;
    }

    /**
     * @return string
     */
    public function getOpenId(): string
    {
        return $this->openid;
    }

    /**
     * @return string
     */
    public function getSubOpenId(): string
    {
        return $this->sub_openid ?: '';
    }

    /**
     * @return null|Carbon
     */
    public function getDeletedAt(): ?Carbon
    {
        return empty($this->deleted_at) ? null : Carbon::parse($this->deleted_at);
    }

    /**
     * @return null|Carbon
     */
    public function getCreatedAt(): ?Carbon
    {
        return empty($this->created_at) ? null : Carbon::parse($this->created_at);
    }

    /**
     * @return null|Carbon
     */
    public function getUpdatedAt(): ?Carbon
    {
        return empty($this->updated_at) ? null : Carbon::parse($this->updated_at);
    }
}
