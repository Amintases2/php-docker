<?php

namespace App\Controllers;

use App\Services\TestService;
use PFW\Framework\Controllers\AbstractController;
use PFW\Framework\Http\Response;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly TestService $service,
    ) {
    }

    public function index(): Response
    {
        return $this->render('home.html.twig', ['name' => 'Marat']);
    }
}
