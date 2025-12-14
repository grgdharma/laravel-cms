<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\FileManagerController;
use App\Http\Controllers\User\PostCommentController;

/*
|--------------------------------------------------------------------------
| Verification Routes
|--------------------------------------------------------------------------
*/
Route::prefix('verification')->group(function () {

    Route::get('/', [RegisterController::class, 'showVerificationForm'])->name('verification.form');
    Route::post('/confirm', [RegisterController::class, 'verification_confirm'])->name('verification.confirm');
});

/*
|--------------------------------------------------------------------------
| User Dashboard Routes (Authenticated)
|--------------------------------------------------------------------------
*/
Route::prefix('user')->middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('user.dashboard');
    Route::get('/edit', [HomeController::class, 'edit_profile'])->name('user.dashboard.edit');
    Route::post('/{id}/update', [HomeController::class, 'update'])->name('user.dashboard.update');

    /*
    |--------------------------------------------------------------
    | File Manager
    |--------------------------------------------------------------
    */
    Route::get('/filemanager', [FileManagerController::class, 'index'])->name('user.filemanager');
    Route::post('/filemanager/upload', [FileManagerController::class, 'upload_file'])->name('user.file.upload');
    Route::post('/filemanager/folder/create', [FileManagerController::class, 'create_folder'])->name('user.create.folder');
    Route::post('/filemanager/delete', [FileManagerController::class, 'delete'])->name('user.delete.file.folder');

    /*
    |--------------------------------------------------------------
    | Post Comments
    |--------------------------------------------------------------
    */
    Route::post('/comment/store', [PostCommentController::class, 'store'])->name('user.comment.store');
});