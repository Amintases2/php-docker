<?php

namespace App\Controllers;

use App\Services\TestService;
use PFW\Framework\Http\Response;
use Twig\Environment;

class HomeController
{
    public function __construct(
        private readonly TestService $service,
        private readonly Environment $twig
    ) {
    }

    public function index(): Response
    {
        $content = $this->service->sayHello();
        dd($this->twig);
        return new Response($content, 200, []);
    }
}
