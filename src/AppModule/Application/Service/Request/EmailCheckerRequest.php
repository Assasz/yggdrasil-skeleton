<?php

namespace AppModule\Application\Service\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class EmailCheckerRequest implements ServiceRequestInterface
{
    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}