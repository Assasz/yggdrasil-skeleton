<?php

namespace Skeleton\Domain\Entity;

/**
 * User entity
 *
 * @Entity(repositoryClass="Skeleton\Application\Repository\UserRepository")
 * @Table(name="`user`")
 *
 * @package Skeleton\Domain\Entity
 */
class User
{
    /**
     * User ID
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    private $id;

    /**
     * User username
     *
     * @Column(type="string", length=36)
     * @var string $username
     */
    private $username;

    /**
     * User email address
     *
     * @Column(type="string", length=255, unique=true)
     * @var string $email
     */
    private $email;

    /**
     * User password
     *
     * @Column(type="string", length=255)
     * @var string $password
     */
    private $password;

    /**
     * User remember token
     *
     * @Column(type="string", length=255, nullable=true)
     * @var null|string $rememberToken
     */
    private $rememberToken;

    /**
     * User remember identifier
     *
     * @Column(type="string", length=255)
     * @var string $rememberIdentifier
     */
    private $rememberIdentifier;

    /**
     * User account status (enabled or not)
     *
     * @Column(type="string", columnDefinition="ENUM('0', '1')")
     * @var string $enabled
     */
    private $isEnabled;

    /**
     * User sign up confirmation token
     *
     * @Column(type="string", length=255)
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
     * @return null|string
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
