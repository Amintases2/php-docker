<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use PFW\Framework\Http\Kernel;
use PFW\Framework\Routing\Router;
use PFW\Framework\Routing\RouterInterface;
use Symfony\Component\Dotenv\Dotenv;

// Applications parametrs

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH . '/.env');

$routes = include BASE_PATH . '/routes/web.php';

$container = new Container();

$container->delegate(new ReflectionContainer(true));

$appEnv = $_ENV['APP_ENV'] ?? 'local';
$container->add('APP_ENV', new StringArgument($appEnv));

$container->add(RouterInterface::class, Router::class);
$container->add(Kernel::class)
    ->addArgument($container)
    ->addArgument(RouterInterface::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes', ['routes' => new ArrayArgument($routes)]);

return $container;
