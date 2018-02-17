<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class SignupResponse implements ServiceResponseInterface
{
    private $success;

    public function __construct()
    {
        $this->success = false;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
}