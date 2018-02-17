<?php

namespace Skeleton\Application\Service\SharedModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class MailSenderResponse implements ServiceResponseInterface
{
    private $success;

    public function __construct()
    {
        $this->success = false;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}