<?php

namespace Skeleton\Application\AppInterface;

/**
 * Interface ValidatorInterface
 *
 * @package Skeleton\Application\AppInterface
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