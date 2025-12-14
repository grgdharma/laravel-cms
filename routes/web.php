<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Social Login Routes
|--------------------------------------------------------------------------
*/
Route::prefix('oauth')->group(function () {
    Route::get('{driver}', [LoginController::class, 'redirectToProvider'])->name('social.oauth');
    Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
});

/*
|--------------------------------------------------------------------------
| Frontend / User Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/frontend/index.php';
require __DIR__ . '/frontend/user.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/admin.php';