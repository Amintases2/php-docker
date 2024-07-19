<?php

use App\Controllers\BiddingController;
use PFW\Framework\Routing\Route;
use PFW\Framework\Http\Response;

return [

    Route::get('/hi/{name}', function (string $name) {
        return new Response("hello, {$name}");
    }),

    Route::get('/api/v1/bidding/create', [BiddingController::class, 'create']),
    Route::post('/api/v1/bidding/create', [BiddingController::class, 'create']),
];
