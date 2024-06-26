<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use PFW\Framework\Routing\Route;
use PFW\Framework\Http\Response;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostController::class, 'show']),
    Route::get('/posts/create', [PostController::class, 'create']),
    // Route::post('/posts/create', [PostController::class, 'show']),
    Route::get('/hi/{name}', function (string $name) {
        return new Response("hello, {$name}");
    }),
];
