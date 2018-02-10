<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class RememberedAuthRequest implements ServiceRequestInterface
{
    private $rememberToken;
    private $rememberIdentifier;

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($rememberToken)
    {
        $this->rememberToken = $rememberToken;
    }

    public function getRememberIdentifier()
    {
        return $this->rememberIdentifier;
    }

    public function setRememberIdentifier($rememberIdentifier)
    {
        $this->rememberIdentifier = $rememberIdentifier;
    }
}