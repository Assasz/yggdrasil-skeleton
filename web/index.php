<?php

$loader = require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Skeleton\Infrastructure\Configuration\AppConfiguration;
use Yggdrasil\Core\Kernel;
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$appConfiguration = new AppConfiguration();

if ('prod' === $appConfiguration->getConfiguration()['framework']['env']) {
    ini_set('display_errors', 0);
}

(new Kernel($appConfiguration))
    ->handle(Request::createFromGlobals())
    ->send();
