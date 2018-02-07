<?php
define('BASE_URL', 'http://localhost/yggdrasil-skeleton/web/');

//for production
//ini_set('display_errors', 0);

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Yggdrasil\Core\Kernel;

$kernel = new Kernel();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();