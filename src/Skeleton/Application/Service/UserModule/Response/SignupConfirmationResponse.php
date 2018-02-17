<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class SignupConfirmationResponse implements ServiceResponseInterface
{
    private $success;
    private $alreadyActive;

    public function __construct()
    {
        $this->success = false;
        $this->alreadyActive = false;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function isAlreadyActive(): bool
    {
        return $this->alreadyActive;
    }

    public function setAlreadyActive(bool $alreadyActive): void
    {
        $this->alreadyActive = $alreadyActive;
    }
}