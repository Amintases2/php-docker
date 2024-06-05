<?php

use Framework\Routing\Route;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use Framework\Http\Response;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostController::class, 'show']),
    Route::get('/hi/{name}', function (string $name) {
        return new Response("hello, {$name}");
    }),
];
