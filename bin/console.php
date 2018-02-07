<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Yggdrasil\Core\Driver\EntityManagerDriver;
use AppModule\Infrastructure\Config\AppConfiguration;

$application = new Application('Yggdrasil CLI', '0.1');

$appConfig = new AppConfiguration();
$configuration = $appConfig->getConfiguration();
$entityManager = EntityManagerDriver::getInstance($configuration);

$helperSet = ConsoleRunner::createHelperSet($entityManager);
$application->setHelperSet($helperSet);

ConsoleRunner::addCommands($application);

// ... register commands

$application->run();