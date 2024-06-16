<?php

namespace App\Controllers;

use App\Services\TestService;
use PFW\Framework\Http\Response;

class HomeController
{
    public function __construct(private readonly TestService $service)
    {
    }

    public function index(): Response
    {
        $content = $this->service->sayHello();

        return new Response($content, 200, []);
    }
}
