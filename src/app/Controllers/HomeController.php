<?php

namespace App\Controllers;

use PFW\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        $content = '<h1>Hello world!</h1>';

        return new Response($content, 200, []);
    }
}
