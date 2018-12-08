<?php

namespace Skeleton\Application\Service\UserModule\Request;

/**
 * Class SignupRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Request
 */
class SignupRequest
{
    /**
     * User email address
     *
     * @var string
     */
    private $email;

    /**
     * User username
     *
     * @var string
     */
    private $username;

    /**
     * User password
     *
     * @var string
     */
    private $password;

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
     * @return SignupRequest
     */
    public function setEmail(string $email): SignupRequest
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns user username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Sets user username
     *
     * @param string $username
     * @return SignupRequest
     */
    public function setUsername(string $username): SignupRequest
    {
        $this->username = $username;

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
     * @return SignupRequest
     */
    public function setPassword(string $password): SignupRequest
    {
        $this->password = $password;

        return $this;
    }
}
