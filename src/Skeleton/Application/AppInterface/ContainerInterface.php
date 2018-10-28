<?php

namespace Skeleton\Application\AppInterface;

use Yggdrasil\Core\Exception\NotServiceReturnedException;
use Yggdrasil\Core\Exception\ServiceNotFoundException;
use Yggdrasil\Core\Service\ServiceInterface;

/**
 * Interface ContainerInterface
 *
 * @package Skeleton\Application\AppInterface
 */
interface ContainerInterface
{
    /**
     * Returns given service from container
     *
     * @param string $alias Alias of service like module.service_name
     * @return ServiceInterface
     *
     * @throws \Exception
     * @throws ServiceNotFoundException if given service doesn't exist
     * @throws NotServiceReturnedException if object returned by container is not a service
     */
    public function getService(string $alias): ServiceInterface;
}