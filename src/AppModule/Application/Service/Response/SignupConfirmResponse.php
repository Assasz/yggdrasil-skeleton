<?php

namespace AppModule\Application\Service\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class SignupConfirmResponse implements ServiceResponseInterface
{
    private $success;
    private $alreadyActive;

    public function __construct()
    {
        $this->success = false;
        $this->alreadyActive = false;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    public function isAlreadyActive()
    {
        return $this->alreadyActive;
    }

    public function setAlreadyActive(bool $alreadyActive)
    {
        $this->alreadyActive = $alreadyActive;
    }
}