<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'front.index');

Route::group(['prefix' => 'media/tiny', 'as' => 'media.tiny.'], function () {
    Route::post('photo/upload', function (){return null;})->name('photo.upload');
    Route::post('media/upload', function (){return null;})->name('media.upload');
    Route::post('file/upload', function (){return null;})->name('file.upload');
});