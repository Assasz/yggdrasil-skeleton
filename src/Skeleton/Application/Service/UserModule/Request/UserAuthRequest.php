<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class UserAuthRequest implements ServiceRequestInterface
{
    private $email;
    private $password;
    private $remember;

    public function getEmail(): string
    {
        return $this->email;
    }

    public  function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRemember(): string
    {
        return $this->remember;
    }

    public function setRemember(bool $remember): void
    {
        $this->remember = $remember;
    }
}
