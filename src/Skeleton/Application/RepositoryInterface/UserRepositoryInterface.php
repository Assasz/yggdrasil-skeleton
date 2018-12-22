<?php

namespace Skeleton\Application\RepositoryInterface;

use Skeleton\Domain\Entity\User;

/**
 * Interface UserRepositoryInterface
 *
 * @package Skeleton\Application\RepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * Finds users by a set of criteria
     *
     * @param array  $criteria
     * @param array? $orderBy
     * @param int?   $limit
     * @param int?   $offset
     * @return array The objects
     */
    public function fetch(array $criteria = [], array $orderBy = null, int $limit = null, int $offset = null): array;

    /**
     * Finds a single user by a set of criteria
     *
     * @param array  $criteria
     * @param array? $orderBy
     * @return User? The entity instance or NULL if the entity can not be found
     */
    public function fetchOne(array $criteria, array $orderBy = null): User;
}
