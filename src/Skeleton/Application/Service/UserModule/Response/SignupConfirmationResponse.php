<?php

namespace Skeleton\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SignupConfirmationResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule\Response
 */
class SignupConfirmationResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * Activation status of user account
     *
     * @var bool
     */
    private $alreadyActive;

    /**
     * SignupConfirmationResponse constructor.
     *
     * Sets default values
     */
    public function __construct()
    {
        $this->success = false;
        $this->alreadyActive = false;
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
     * @return SignupConfirmationResponse
     */
    public function setSuccess(bool $success): SignupConfirmationResponse
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Returns activation status of user account
     *
     * @return bool
     */
    public function isAlreadyActive(): bool
    {
        return $this->alreadyActive;
    }

    /**
     * Sets activation status of user account
     *
     * @param bool $alreadyActive
     * @return SignupConfirmationResponse
     */
    public function setAlreadyActive(bool $alreadyActive): SignupConfirmationResponse
    {
        $this->alreadyActive = $alreadyActive;

        return $this;
    }
}
