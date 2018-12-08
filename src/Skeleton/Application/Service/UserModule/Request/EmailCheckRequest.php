<?php

namespace Skeleton\Application\Service\UserModule\Request;

/**
 * Class EmailCheckRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Request
 */
class EmailCheckRequest
{
    /**
     * User email address
     *
     * @var string
     */
    private $email;

    /**
     * Returns email address
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets email address
     *
     * @param string $email
     * @return EmailCheckRequest
     */
    public function setEmail(string $email): EmailCheckRequest
    {
        $this->email = $email;

        return $this;
    }
}
