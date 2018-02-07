<?php

namespace AppModule\Application\Service\Response;

use AppModule\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class UserAuthResponse implements ServiceResponseInterface
{
    private $success;
    private $user;
    private $rememberToken;
    private $enabled;

    public function __construct()
    {
        $this->success = false;
        $this->enabled = true;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($rememberToken)
    {
        $this->rememberToken = $rememberToken;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;
    }
}