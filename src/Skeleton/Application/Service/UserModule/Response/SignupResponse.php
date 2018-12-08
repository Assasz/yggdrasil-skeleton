<?php

namespace Skeleton\Application\Service\UserModule\Response;

/**
 * Class SignupResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Response
 */
class SignupResponse
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * SignupResponse constructor.
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
     * @return SignupResponse
     */
    public function setSuccess(bool $success): SignupResponse
    {
        $this->success = $success;

        return $this;
    }
}
