<?php

namespace Skeleton\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
use Skeleton\Domain\Entity\User;

/**
 * Class UserRepository
 *
 * Repository of User entity
 *
 * @package Skeleton\Infrastructure\Repository
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * Returns users by a set of criteria
     *
     * @param array  $criteria
     * @param array? $orderBy
     * @param int?   $limit
     * @param int?   $offset
     * @return array
     */
    public function fetch(array $criteria = [], array $orderBy = null, int $limit = null, int $offset = null): array
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Returns a single user by a set of criteria
     *
     * @param array  $criteria
     * @param array? $orderBy
     * @return User? The entity instance or NULL if the entity can not be found
     */
    public function fetchOne(array $criteria, array $orderBy = null): ?User
    {
        return $this->findOneBy($criteria, $orderBy);
    }
}
