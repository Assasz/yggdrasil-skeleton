<?php

namespace Skeleton\Application\Exception;

/**
 * Class BrokenContractException
 *
 * Thrown when contract between client and supplier has broken
 *
 * @package Skeleton\Application\Exception
 */
class BrokenContractException extends \LogicException
{
    /**
     * BrokenContractException constructor.
     *
     * @param string      $contract Contract name
     * @param int         $code
     * @param \Throwable? $previous
     */
    public function __construct(string $contract, int $code = 0, \Throwable $previous = null)
    {
        $message = $contract . ' contract has broken.';

        parent::__construct($message, $code, $previous);
    }
}