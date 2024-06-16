<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

use PFW\Framework\Http\Request;
use PFW\Framework\Http\Kernel;

$request = Request::createFromGlobals();

/** @var  \League\Container\Container $container */
$container = require_once BASE_PATH . '/config/services.php';

$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);

$response->send();
