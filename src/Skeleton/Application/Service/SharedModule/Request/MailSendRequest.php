<?php

namespace Skeleton\Application\Service\SharedModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class MailSendRequest
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\SharedModule\Request
 */
class MailSendRequest implements ServiceRequestInterface
{
    /**
     * Mail subject
     *
     * @var string
     */
    private $subject;

    /**
     * Mail body
     *
     * @var string
     */
    private $body;

    /**
     * Set of senders
     *
     * @var array
     */
    private $sender;

    /**
     * Set of receivers
     *
     * @var array
     */
    private $receivers;

    /**
     * MailSendRequest constructor.
     *
     * Initialises arrays
     */
    public function __construct()
    {
        $this->sender = [];
        $this->receivers = [];
    }

    /**
     * Returns mail subject
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Sets mail subject
     *
     * @param string $subject
     * @return MailSendRequest
     */
    public function setSubject(string $subject): MailSendRequest
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Returns mail body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Sets mail body
     *
     * @param string $body
     * @return MailSendRequest
     */
    public function setBody(string $body): MailSendRequest
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Returns set of senders
     *
     * @return array
     */
    public function getSender(): array
    {
        return $this->sender;
    }

    /**
     * Sets set of senders
     *
     * @param array $sender
     * @return MailSendRequest
     */
    public function setSender(array $sender): MailSendRequest
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Returns set of receivers
     *
     * @return array
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    /**
     * Sets set of receivers
     *
     * @param array $receivers
     * @return MailSendRequest
     */
    public function setReceivers(array $receivers): MailSendRequest
    {
        $this->receivers = $receivers;

        return $this;
    }
}
