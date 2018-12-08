<?php

namespace Skeleton\Application\Service\UserModule\Request;

/**
 * Class SignupConfirmationRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Request
 */
class SignupConfirmationRequest
{
    /**
     * Confirmation token
     *
     * @var string
     */
    private $token;

    /**
     * Returns confirmation token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Sets confirmation token
     *
     * @param string $token
     * @return SignupConfirmationRequest
     */
    public function setToken(string $token): SignupConfirmationRequest
    {
        $this->token = $token;

        return $this;
    }
}
