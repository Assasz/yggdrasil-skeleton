<?php

namespace AppModule\Application\Service\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;
use AppModule\Domain\Entity\User;

class RememberedAuthResponse implements ServiceResponseInterface
{
    private $success;
    private $user;

    public function __construct()
    {
        $this->success = false;
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
}