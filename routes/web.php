<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Posts
Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
    Route::post('create', [\App\Content\Http\Controller\PostController::class, 'store']);
    Route::patch('{post}/update', [\App\Content\Http\Controller\PostController::class, 'update']);

    Route::group(['as' => 'comments.'], function () {
        Route::post('{posts}/comments/create', [\App\Content\Http\Controller\AddCommentToPostController::class, 'store'])->name('create');
        Route::patch('comments/{comment}/update', [\App\Content\Http\Controller\AddCommentToPostController::class, 'update'])->name('update');
    });
});
