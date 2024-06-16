<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Container;
use PFW\Framework\Http\Kernel;
use PFW\Framework\Routing\Router;
use PFW\Framework\Routing\RouterInterface;

// Applications parametrs

$routes = include BASE_PATH . '/routes/web.php';

$container = new Container();

$container->add(RouterInterface::class, Router::class);
$container->add(Kernel::class)->addArgument(RouterInterface::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes', ['routes' => new ArrayArgument($routes)]);

return $container;
