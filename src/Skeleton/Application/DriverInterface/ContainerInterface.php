<?php

namespace Skeleton\Application\DriverInterface;

use Yggdrasil\Core\Exception\NotServiceReturnedException;
use Yggdrasil\Core\Exception\ServiceNotFoundException;
use Yggdrasil\Core\Service\AbstractService;

/**
 * Interface ContainerInterface
 *
 * @package Skeleton\Application\DriverInterface
 */
interface ContainerInterface
{
    /**
     * Returns given service from container
     *
     * @param string $alias Alias of service like module.service_name
     * @return AbstractService
     *
     * @throws \Exception
     * @throws ServiceNotFoundException if given service doesn't exist
     * @throws NotServiceReturnedException if object returned by container is not a service
     */
    public function getService(string $alias): AbstractService;
}