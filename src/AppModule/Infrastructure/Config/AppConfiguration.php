<?php

namespace AppModule\Infrastructure\Config;

use Yggdrasil\Core\Configuration\AbstractConfiguration;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\ContainerDriver;
use Yggdrasil\Core\Driver\EntityManagerDriver;
use Yggdrasil\Core\Driver\ExceptionHandlerDriver;
use Yggdrasil\Core\Driver\MailerDriver;
use Yggdrasil\Core\Driver\RoutingDriver;
use Yggdrasil\Core\Driver\TemplateEngineDriver;
use Yggdrasil\Core\Driver\ValidatorDriver;

class AppConfiguration extends AbstractConfiguration implements ConfigurationInterface
{
    public function __construct()
    {
        parent::__construct('AppModule/Infrastructure/Config');

        $this->drivers = [
            'exceptionHandler' => ExceptionHandlerDriver::class,
            'router' => RoutingDriver::class,
            'entityManager' => EntityManagerDriver::class,
            'templateEngine' => TemplateEngineDriver::class,
            'container' => ContainerDriver::class,
            'validator' => ValidatorDriver::class,
            'mailer' => MailerDriver::class
        ];
    }
}