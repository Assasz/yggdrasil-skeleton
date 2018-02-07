<?php

namespace AppModule\Application\Service\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class MailSenderResponse implements ServiceResponseInterface
{
    private $success;

    public function __construct()
    {
        $this->success = false;
    }

    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    public function isSuccess()
    {
        return $this->success;
    }
}