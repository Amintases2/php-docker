<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use PFW\Framework\Artisan\Application;
use PFW\Framework\Artisan\Kernel as ArtisanKernel;
use PFW\Framework\Controllers\AbstractController;
use PFW\Framework\Http\Kernel;
use PFW\Framework\Db\ConnectionFactory;
use PFW\Framework\Routing\Router;
use PFW\Framework\Routing\RouterInterface;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use \PFW\Framework\Artisan\Commands\MigrateCommand;
use PFW\Framework\Artisan\Commands\RollBackCommand;

$container = new Container();
$container->delegate(new ReflectionContainer(true));

// ENV
$dotenv = new Dotenv();
$dotenv->load(BASE_PATH . '/.env');
$appEnv = $_ENV['APP_ENV'] ?? 'local';
$container->add('APP_ENV', new StringArgument($appEnv));

// DATABASE
$container->add(ConnectionFactory::class)
    ->addMethodCall('createConnection');

// ARTISAN
$container->add(ArtisanKernel::class)
    ->addArgument($container);
$container->add('framework-commands-namespace', new StringArgument('PFW\\Framework\\Artisan\\Commands\\'));

// ARTISAN COMMANDS
$container->add('console:db:migrate', MigrateCommand::class)
    ->addArgument(ConnectionFactory::class)
    ->addArgument(new StringArgument(BASE_PATH . '/database/migrations'));
$container->add('console:db:rollback', RollBackCommand::class)
    ->addArgument(ConnectionFactory::class)
    ->addArgument(new StringArgument(BASE_PATH . '/database/migrations'));

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
