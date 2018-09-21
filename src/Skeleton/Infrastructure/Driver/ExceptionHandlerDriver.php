<?php

namespace Skeleton\Infrastructure\Driver;

use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\ExceptionHandlerDriver as AbstractDriver;

/**
 * Class ExceptionHandlerDriver
 *
 * Overridden core driver
 *
 * @package Skeleton\Infrastructure\Driver
 */
class ExceptionHandlerDriver extends AbstractDriver
{
    /**
     * Returns handler for production mode
     *
     * @param ConfigurationInterface $appConfiguration
     * @return \Closure
     */
    protected static function getProdHandler(ConfigurationInterface $appConfiguration): \Closure
    {
        return function () use ($appConfiguration) {
            echo $appConfiguration->loadDriver('templateEngine')->render('error/500.html.twig');
        };
    }
}