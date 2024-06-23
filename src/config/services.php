<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use PFW\Framework\Controllers\AbstractController;
use PFW\Framework\Http\Kernel;
use PFW\Framework\Routing\Router;
use PFW\Framework\Routing\RouterInterface;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$container = new Container();
$container->delegate(new ReflectionContainer(true));

// ENV
$dotenv = new Dotenv();
$dotenv->load(BASE_PATH . '/.env');
$appEnv = $_ENV['APP_ENV'] ?? 'local';
$container->add('APP_ENV', new StringArgument($appEnv));

// ROUTES
$routes = include BASE_PATH . '/routes/web.php';
$container->add(RouterInterface::class, Router::class);
$container->add(Kernel::class)
    ->addArgument($container)
    ->addArgument(RouterInterface::class);
$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes', ['routes' => new ArrayArgument($routes)]);

// VIEWS
$views = BASE_PATH . '/views';
$container->addShared('twig-loader', FilesystemLoader::class)
    ->addArgument(new StringArgument($views));

$container->addShared('twig', Environment::class)
    ->addArgument('twig-loader');

$container->inflector(AbstractController::class)
    ->invokeMethod('setContainer', [$container]);




return $container;
