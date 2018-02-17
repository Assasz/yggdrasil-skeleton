<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Skeleton\Infrastructure\Config\AppConfiguration;

$application = new Application('Yggdrasil CLI', '0.1');

$appConfig = new AppConfiguration();
$entityManager = $appConfig->loadDriver('entityManager');

$helperSet = ConsoleRunner::createHelperSet($entityManager);
$application->setHelperSet($helperSet);

ConsoleRunner::addCommands($application);

// ... register commands

$application->run();