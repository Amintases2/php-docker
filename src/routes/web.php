<?php

use App\Controllers\BiddingController;
use PFW\Framework\Routing\Route;
use PFW\Framework\Http\Response;

return [

    Route::get('/', function () {
        return new Response(['name' => 'Hello from service']);
    }),

    Route::get('/api/v1/bidding/create', [BiddingController::class, 'create']),
    Route::post('/api/v1/bidding/create', [BiddingController::class, 'create']),
];
