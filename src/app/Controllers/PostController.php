<?php

namespace App\Controllers;

use PFW\Framework\Controllers\AbstractController;
use PFW\Framework\Http\Response;

class PostController extends AbstractController
{
    public function show($id): Response
    {
        return $this->render('post.html.twig', ['postId' => $id]);
    }

    public function create(): Response
    {
        return $this->render('post_create.html.twig');
    }
}
