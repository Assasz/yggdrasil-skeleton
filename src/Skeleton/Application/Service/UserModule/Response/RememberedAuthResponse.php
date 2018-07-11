<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;
use Skeleton\Domain\Entity\User;

/**
 * Class RememberedAuthResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Response
 */
class RememberedAuthResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * Authenticated user instance
     *
     * @var User
     */
    private $user;

    /**
     * RememberedAuthResponse constructor.
     *
     * Sets default value of $success
     */
    public function __construct()
    {
        $this->success = false;
    }

    /**
     * Returns result of service processing
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Sets result of service processing
     *
     * @param bool $success
     * @return RememberedAuthResponse
     */
    public function setSuccess(bool $success): RememberedAuthResponse
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Returns authenticated user instance
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Sets authenticated user instance
     *
     * @param User $user
     * @return RememberedAuthResponse
     */
    public function setUser(User $user): RememberedAuthResponse
    {
        $this->user = $user;

        return $this;
    }
}
