<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class UserAuthRequest implements ServiceRequestInterface
{
    private $email;
    private $password;
    private $remember;

    public  function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRemember()
    {
        return $this->remember;
    }

    public function setRemember(bool $remember)
    {
        $this->remember = $remember;
    }
}
