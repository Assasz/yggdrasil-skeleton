<?php

namespace Skeleton\Application\Service\SharedModule\Response;

/**
 * Class MailSendResponse
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\SharedModule\Response
 */
class MailSendResponse
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * MailSendResponse constructor.
     *
     * Sets default value for $success
     */
    public function __construct()
    {
        $this->success = false;
    }

    /**
     * Returns result of service processing
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Sets result of service processing
     *
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
}
