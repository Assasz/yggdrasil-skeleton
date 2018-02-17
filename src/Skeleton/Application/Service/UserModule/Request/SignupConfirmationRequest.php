<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class SignupConfirmationRequest implements ServiceRequestInterface
{
    private $token;

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): string
    {
        $this->token = $token;
    }
}