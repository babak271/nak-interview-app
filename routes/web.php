<?php

use App\Content\Http\Controller\AddCommentToPostController;
use App\Content\Http\Controller\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index']);

// Media
Route::group(['prefix' => 'media/tiny', 'as' => 'media.tiny.'], function () {
    Route::post('photo/upload', function (){return null;})->name('photo.upload');
    Route::post('media/upload', function (){return null;})->name('media.upload');
    Route::post('file/upload', function (){return null;})->name('file.upload');
});

// Posts
Route::resource('posts', PostController::class)->except(['show', 'create', 'edit']);
Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {

    Route::group(['as' => 'comments.'], function () {
        Route::post('{posts}/comments/create', [AddCommentToPostController::class, 'store'])->name('create');
        Route::patch('comments/{comment}/update', [AddCommentToPostController::class, 'update'])->name('update');
    });
});
