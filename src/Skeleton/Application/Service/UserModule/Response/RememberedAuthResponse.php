<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;
use Skeleton\Domain\Entity\User;

class RememberedAuthResponse implements ServiceResponseInterface
{
    private $success;
    private $user;

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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}