<?php

namespace PFW\Framework\Routing;

use League\Container\Container;
use PFW\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request, Container $container);
    public function registerRoutes(array $routes);
}
