<?php

namespace PFW\Framework\Routing;

use PFW\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
    public function registerRoutes(array $routes);
}
