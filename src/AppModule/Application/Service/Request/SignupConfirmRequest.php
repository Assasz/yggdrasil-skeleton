<?php

namespace AppModule\Application\Service\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class SignupConfirmRequest implements ServiceRequestInterface
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