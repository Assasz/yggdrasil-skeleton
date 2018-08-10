<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class EmailCheckResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Response
 */
class EmailCheckResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * EmailCheckResponse constructor.
     *
     * Sets default value of $success
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
     * @return EmailCheckResponse
     */
    public function setSuccess(bool $success): EmailCheckResponse
    {
        $this->success = $success;

        return $this;
    }
}