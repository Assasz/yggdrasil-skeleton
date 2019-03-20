<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Skeleton\Infrastructure\Configuration\AppConfiguration;
use Yggdrasil\Utils\Entity\EntityGenerateCommand;
use Yggdrasil\Utils\Service\ServiceDTOGenerateCommand;
use Yggdrasil\Utils\Seeds\SeedsPersistCommand;

try {
    $consoleApplication = new Application('Yggdrasil CLI', 'dev');
    $appConfiguration   = new AppConfiguration();

    $consoleModule = (!isset($argv[1])) ?: explode(':', $argv[1])[0];

    switch (true) {
        case in_array($consoleModule, ['dbal', 'orm']):
            $helperSet = ConsoleRunner::createHelperSet(
                $appConfiguration->loadDriver('entityManager')->getComponentInstance()
            );

            $consoleApplication->setHelperSet($helperSet);
            ConsoleRunner::addCommands($consoleApplication);

            break;
        default:
            // register commands here
            $consoleApplication->add(new EntityGenerateCommand($appConfiguration));
            $consoleApplication->add(new ServiceDTOGenerateCommand($appConfiguration));
            $consoleApplication->add(new SeedsPersistCommand($appConfiguration));

            break;
    }

    $consoleApplication->run();
} catch (Throwable $t) {
    echo "Console error: {$t->getMessage()} at line {$t->getLine()} in {$t->getFile()}";
}
