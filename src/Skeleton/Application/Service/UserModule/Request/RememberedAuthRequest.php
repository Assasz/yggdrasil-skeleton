<?php

namespace Skeleton\Application\Service\UserModule\Request;

/**
 * Class RememberedAuthRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Request
 */
class RememberedAuthRequest
{
    /**
     * User remember token from cookie
     *
     * @var string
     */
    private $rememberToken;

    /**
     * User remember identifier from cookie
     *
     * @var string
     */
    private $rememberIdentifier;

    /**
     * Returns remember token
     *
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    /**
     * Sets remember token
     *
     * @param string $rememberToken
     * @return RememberedAuthRequest
     */
    public function setRememberToken(string $rememberToken): RememberedAuthRequest
    {
        $this->rememberToken = $rememberToken;

        return $this;
    }

    /**
     * Returns remember identifier
     *
     * @return string
     */
    public function getRememberIdentifier(): string
    {
        return $this->rememberIdentifier;
    }

    /**
     * Sets remember identifier
     *
     * @param string $rememberIdentifier
     * @return RememberedAuthRequest
     */
    public function setRememberIdentifier(string $rememberIdentifier): RememberedAuthRequest
    {
        $this->rememberIdentifier = $rememberIdentifier;

        return $this;
    }
}
