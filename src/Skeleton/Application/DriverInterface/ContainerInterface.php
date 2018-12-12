<?php

namespace Skeleton\Application\DriverInterface;

use Yggdrasil\Utils\Service\AbstractService;

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
     */
    public function getService(string $alias): AbstractService;
}
