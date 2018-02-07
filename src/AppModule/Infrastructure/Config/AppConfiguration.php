<?php

namespace AppModule\Infrastructure\Config;

use Yggdrasil\Core\AbstractConfiguration;
use Yggdrasil\Core\Driver\ContainerDriver;
use Yggdrasil\Core\Driver\EntityManagerDriver;
use Yggdrasil\Core\Driver\ExceptionHandlerDriver;
use Yggdrasil\Core\Driver\MailerDriver;
use Yggdrasil\Core\Driver\RoutingDriver;
use Yggdrasil\Core\Driver\TemplateEngineDriver;
use Yggdrasil\Core\Driver\ValidatorDriver;

class AppConfiguration extends AbstractConfiguration
{
    public function __construct()
    {
        parent::__construct();

        $this->drivers = [
            'router' => RoutingDriver::class,
            'entityManager' => EntityManagerDriver::class,
            'templateEngine' => TemplateEngineDriver::class,
            'exceptionHandler' => ExceptionHandlerDriver::class,
            'container' => ContainerDriver::class,
            'validator' => ValidatorDriver::class,
            'mailer' => MailerDriver::class
        ];
    }
}