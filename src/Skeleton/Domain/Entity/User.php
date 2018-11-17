<?php

namespace Skeleton\Domain\Entity;

/**
 * User entity
 *
 * @package Skeleton\Domain\Entity
 */
class User
{
    /**
     * User ID
     *
     * @var int $id
     */
    private $id;

    /**
     * User username
     *
     * @var string $username
     */
    private $username;

    /**
     * User email address
     *
     * @var string $email
     */
    private $email;

    /**
     * User password
     *
     * @var string $password
     */
    private $password;

    /**
     * User remember token
     *
     * @var string? $rememberToken
     */
    private $rememberToken;

    /**
     * User remember identifier
     *
     * @var string $rememberIdentifier
     */
    private $rememberIdentifier;

    /**
     * User account status (enabled or not)
     *
     * @var string $enabled
     */
    private $isEnabled;

    /**
     * User sign up confirmation token
     *
     * @var string $confirmationToken
     */
    private $confirmationToken;

    /**
     * User constructor.
     *
     * Sets default values
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this
            ->setRememberIdentifier(bin2hex(random_bytes(32)))
            ->setConfirmationToken(bin2hex(random_bytes(32)))
            ->setEnabled('0');
    }

    /**
     * Returns user ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Returns user email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets user email
     *
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
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
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returns user remember token
     *
     * @return string?
     */
    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    /**
     * Sets user remember token
     *
     * @param string $token
     * @return User
     */
    public function setRememberToken(string $token): User
    {
        $this->rememberToken = $token;

        return $this;
    }

    /**
     * Returns user remember identifier
     *
     * @return string
     */
    public function getRememberIdentifier(): string
    {
        return $this->rememberIdentifier;
    }

    /**
     * Sets user remember identifier
     *
     * @param string $rememberIdentifier
     * @return User
     */
    public function setRememberIdentifier(string $rememberIdentifier): User
    {
        $this->rememberIdentifier = $rememberIdentifier;

        return $this;
    }

    /**
     * Returns user account status
     *
     * @return string
     */
    public function isEnabled(): string
    {
        return $this->isEnabled;
    }

    /**
     * Sets user account status
     *
     * @param string $enabled
     * @return User
     */
    public function setEnabled(string $enabled): User
    {
        $this->isEnabled = $enabled;

        return $this;
    }

    /**
     * Returns user confirmation token
     *
     * @return string
     */
    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }

    /**
     * Sets user confirmation token
     *
     * @param string $confirmationToken
     * @return User
     */
    public function setConfirmationToken(string $confirmationToken): User
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }
}
