<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Posts
Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
    Route::post('create', [\Domain\Content\Http\Controller\PostController::class, 'store']);
});
