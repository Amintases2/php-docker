<?php

namespace App\Controllers;

use PFW\Framework\Controllers\AbstractController;
use PFW\Framework\Http\Response;

class BiddingController extends AbstractController
{
    public function create()
    {
        return new Response(['message' => 'OK']);
    }
}
