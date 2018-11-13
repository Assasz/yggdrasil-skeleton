<?php

namespace Skeleton\Application\DriverInterface;

/**
 * Interface RouterInterface
 *
 * @package Skeleton\Application\DriverInterface
 */
interface RouterInterface
{
    /**
     * Returns absolute path for requested action
     *
     * @param string $alias Alias of action like Controller:action
     * @param array $params Set of action parameters
     * @return string
     */
    public function getQuery(string $alias, array $params = []): string;
}