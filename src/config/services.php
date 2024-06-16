<?php

use League\Container\Container;
use PFW\Framework\Http\Kernel;
use PFW\Framework\Routing\Router;
use PFW\Framework\Routing\RouterInterface;

$container = new Container();

$container->add(RouterInterface::class, Router::class);
$container->add(Kernel::class)->addArgument(RouterInterface::class);


return $container;
