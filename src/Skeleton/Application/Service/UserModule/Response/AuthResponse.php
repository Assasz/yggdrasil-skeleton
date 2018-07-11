<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Skeleton\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class AuthResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Response
 */
class AuthResponse implements ServiceResponseInterface
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
     * Remember me token in plain text
     *
     * @var string
     */
    private $rememberToken;

    /**
     * User enabled status
     *
     * @var bool
     */
    private $enabled;

    /**
     * AuthResponse constructor.
     *
     * Sets default values
     */
    public function __construct()
    {
        $this->success = false;
        $this->enabled = true;
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
     * @return AuthResponse
     */
    public function setSuccess(bool $success): AuthResponse
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
     * @return AuthResponse
     */
    public function setUser(User $user): AuthResponse
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Returns remember me token
     *
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    /**
     * Sets remember me token
     *
     * @param string $rememberToken
     * @return AuthResponse
     */
    public function setRememberToken(string $rememberToken): AuthResponse
    {
        $this->rememberToken = $rememberToken;

        return $this;
    }

    /**
     * Returns user enabled status
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Sets user enabled status
     *
     * @param bool $enabled
     * @return AuthResponse
     */
    public function setEnabled(bool $enabled): AuthResponse
    {
        $this->enabled = $enabled;

        return $this;
    }
}
