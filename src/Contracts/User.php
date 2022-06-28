<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/28
 * Time: 19:26
 */

namespace HughCube\Laravel\OAuthStorage\Contracts;

use Carbon\Carbon;

interface User
{
    /**
     * @return string
     */
    public function getAppid(): string;

    /**
     * @return string
     */
    public function getAppType(): string;

    /**
     * @return string
     */
    public function getService(): string;

    /**
     * @return string
     */
    public function getUserType(): string;

    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @return string
     */
    public function getOpenId(): string;

    /**
     * @return string
     */
    public function getSubOpenId(): string;

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
}
