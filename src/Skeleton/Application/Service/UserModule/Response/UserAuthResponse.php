<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Skeleton\Domain\Entity\User;
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

    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    public function setRememberToken(string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
}