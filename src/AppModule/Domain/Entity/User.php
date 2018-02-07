<?php

namespace AppModule\Domain\Entity;

/**
 * @Entity(repositoryClass="AppModule\Application\Repository\UserRepository")
 * @Table(name="`user`")
 */
class User
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(type="string", length=36)
     */
    private $username;

    /**
     * @Column(type="string", length=255)
     */
    private $email;

    /**
     * @Column(type="string", length=255)
     */
    private $password;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    private $rememberToken;

    /**
     * @Column(type="string", length=255)
     */
    private $rememberIdentifier;

    /**
     * @Column(type="string", columnDefinition="ENUM('0', '1')")
     */
    private $enabled;

    /**
     * @Column(type="string", length=255)
     */
    private $confirmationToken;

    public function __construct()
    {
        $this->rememberIdentifier = bin2hex(random_bytes(32));
        $this->enabled = '0';
        $this->confirmationToken = bin2hex(random_bytes(32));
    }

    public function getIt()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($token)
    {
        $this->rememberToken = $token;
    }

    public function getRememberIdentifier()
    {
        return $this->rememberIdentifier;
    }

    public function setRememberIdentifier($rememberIdentifier)
    {
        $this->rememberIdentifier = $rememberIdentifier;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }
}