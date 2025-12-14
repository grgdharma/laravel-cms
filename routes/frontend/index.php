<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::controller(FrontendController::class)->group(function () {

    Route::get('/', 'index')->name('home');
    Route::get('/demo', 'demo')->name('demo');

    Route::get('/page/{slug}', 'page_detail')->name('page.detail');
    Route::get('/blog/category/{slug}', 'postByCategory')->name('category.post');
    Route::get('/blog/{slug}', 'post_detail')->name('post.detail');
});