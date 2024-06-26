<?php

namespace PFW\Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use League\Container\Container;
use PFW\Framework\Http\Request;
use PFW\Framework\Http\Exceptions\MethodNotAllowedException;
use PFW\Framework\Http\Exceptions\NotFoundException;

use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    private array $routes;

    public function registerRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(Request $request, Container $container): array
    {
        [$handler, $vars] = $this->extractRouteInfo($request);

        if (is_array($handler)) {
            [$controllerId, $method] = $handler;
            $controller = $container->get($controllerId);
            $handler = [$controller, $method];
        }

        return [$handler, $vars];
    }


    private function extractRouteInfo(Request $request)
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {

            foreach ($this->routes as $route) {
                $collector->addRoute(...$route);
            }
        });
        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [$routeInfo[1], $routeInfo[2]];

            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);

                throw new MethodNotAllowedException("Supported HTTP Methods: $allowedMethods");

            default:
                throw new NotFoundException('Route Not Found');
        }
    }
}
