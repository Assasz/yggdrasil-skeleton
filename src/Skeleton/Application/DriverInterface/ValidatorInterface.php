<?php

namespace Skeleton\Application\DriverInterface;

/**
 * Interface ValidatorInterface
 *
 * @package Skeleton\Application\DriverInterface
 */
interface ValidatorInterface
{
    /**
     * Checks if given entity object is valid or not
     *
     * @param object $entity
     * @return bool
     */
    public function isValid(object $entity): bool;
}