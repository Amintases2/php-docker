<?php

namespace App\Controllers;

use PFW\Framework\Http\Response;

class PostController
{
    public function show($id): Response
    {
        $content = "<h1>Post #{$id}</h1>";

        return new Response($content, 200, []);
    }
}
