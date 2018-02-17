<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class RememberedAuthRequest implements ServiceRequestInterface
{
    private $rememberToken;
    private $rememberIdentifier;

    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    public function setRememberToken(string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    public function getRememberIdentifier(): string
    {
        return $this->rememberIdentifier;
    }

    public function setRememberIdentifier(string $rememberIdentifier): void
    {
        $this->rememberIdentifier = $rememberIdentifier;
    }
}