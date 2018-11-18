<?php

namespace Skeleton\Application\RepositoryInterface;

/**
 * Interface UserRepositoryInterface
 *
 * @package Skeleton\Application\RepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * Finds entities by a set of criteria
     *
     * @param array  $criteria
     * @param array? $orderBy
     * @param int?   $limit
     * @param int?   $offset
     *
     * @return array The objects
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Finds a single entity by a set of criteria
     *
     * @param array  $criteria
     * @param array? $orderBy
     *
     * @return object? The entity instance or NULL if the entity can not be found
     */
    public function findOneBy(array $criteria, array $orderBy = null);
}