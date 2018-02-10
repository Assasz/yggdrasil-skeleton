<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class SignupConfirmationRequest implements ServiceRequestInterface
{
    private $token;

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }
}