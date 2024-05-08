<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\Kernel;

$request = Request::createFromGlobals();

$kernel = new Kernel();
$response = $kernel->handle($request);
$response->send();
