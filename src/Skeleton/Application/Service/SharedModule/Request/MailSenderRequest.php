<?php

namespace Skeleton\Application\Service\SharedModule\Request;

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

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getSender(): array
    {
        return $this->sender;
    }

    public function setSender(array $sender)
    {
        $this->sender = $sender;
    }

    public function getReceivers(): array
    {
        return $this->receivers;
    }

    public function setReceivers(array $receivers)
    {
        $this->receivers = $receivers;
    }
}