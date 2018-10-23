<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class AuthRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Request
 *
 */
class AuthRequest implements ServiceRequestInterface
{
    /**
     * User email address
     *
     * @var string
     */
    private $email;

    /**
     * User password
     *
     * @var string
     */
    private $password;

    /**
     * "Remember me" flag
     *
     * @var bool
     */
    private $remembered;

    /**
     * Returns user email address
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets user email address
     *
     * @param string $email
     * @return AuthRequest
     */
    public function setEmail(string $email): AuthRequest
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns user password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets user password
     *
     * @param string $password
     * @return AuthRequest
     */
    public function setPassword(string $password): AuthRequest
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Indicates if user checked "remember me"
     *
     * @return bool
     */
    public function isRemembered(): bool
    {
        return $this->remembered;
    }

    /**
     * Sets "remember me" flag
     *
     * @param bool $remembered
     * @return AuthRequest
     */
    public function setRemembered(bool $remembered): AuthRequest
    {
        $this->remembered = $remembered;

        return $this;
    }
}
