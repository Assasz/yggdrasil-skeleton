<?php

namespace Skeleton\Infrastructure\Configuration;

use Yggdrasil\Core\Configuration\AbstractConfiguration;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Skeleton\Infrastructure\Driver\CacheDriver;
use Skeleton\Infrastructure\Driver\ContainerDriver;
use Skeleton\Infrastructure\Driver\EntityManagerDriver;
use Skeleton\Infrastructure\Driver\ExceptionHandlerDriver;
use Skeleton\Infrastructure\Driver\MailerDriver;
use Skeleton\Infrastructure\Driver\RouterDriver;
use Skeleton\Infrastructure\Driver\TemplateEngineDriver;
use Skeleton\Infrastructure\Driver\ValidatorDriver;

/**
 * Class AppConfiguration
 *
 * Manages configuration of application
 *
 * @package Skeleton\Infrastructure\Configuration
 */
class AppConfiguration extends AbstractConfiguration implements ConfigurationInterface
{
    /**
     * Returns application config path
     *
     * @return string
     */
    protected function getConfigPath(): string
    {
        return 'Skeleton/Infrastructure/Configuration';
    }

    /**
     * Returns application drivers registry
     *
     * @return array
     */
    protected function getDriverRegistry(): array
    {
        return [
            'exceptionHandler' => ExceptionHandlerDriver::class,
            'router' => RouterDriver::class,
            'entityManager' => EntityManagerDriver::class,
            'templateEngine' => TemplateEngineDriver::class,
            'container' => ContainerDriver::class,
            'validator' => ValidatorDriver::class,
            'mailer' => MailerDriver::class,
            // Uncomment if have Redis installed
            // 'cache' => CacheDriver::class,
        ];
    }
}
