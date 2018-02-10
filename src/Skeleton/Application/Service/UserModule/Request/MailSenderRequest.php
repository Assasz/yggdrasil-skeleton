<?php

namespace Skeleton\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

class MailSenderRequest implements ServiceRequestInterface
{
    private $subject;
    private $body;
    private $sender;
    private $receivers;

    public function __construct()
    {
        $this->sender = [];
        $this->receivers = [];
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setSender(array $sender)
    {
        $this->sender = $sender;
    }

    public function getReceivers()
    {
        return $this->receivers;
    }

    public function setReceivers(array $receivers)
    {
        $this->receivers = $receivers;
    }
}