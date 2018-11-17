<?php

namespace Skeleton\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * Repository of user entity
 *
 * @package Skeleton\Infrastructure\Repository
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{

}
