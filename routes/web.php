<?php

use App\Content\Http\Controller\AddCommentToPostController;
use App\Content\Http\Controller\PostController;
use App\Media\Http\Controller\MediaController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index']);

// Media
Route::group(['prefix' => 'media/tiny', 'as' => 'media.tiny.'], function () {
    Route::post('photo/upload', [MediaController::class, 'uploadTinyPhoto'])->name('photo.upload');
    Route::post('media/upload', [MediaController::class, 'uploadTinyMedia'])->name('media.upload');
    Route::post('file/upload', [MediaController::class, 'uploadTinyFile'])->name('file.upload');
});

// Posts
Route::resource('posts', PostController::class)->except(['show', 'create', 'edit']);
Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {

    Route::group(['as' => 'comments.'], function () {
        Route::post('{post}/comments', [AddCommentToPostController::class, 'store'])->name('store');
        Route::patch('comments/{comment}/update', [AddCommentToPostController::class, 'update'])->name('update');
    });
});
