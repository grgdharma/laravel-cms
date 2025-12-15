<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Auth Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| System Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\{
    DashboardController,
    GeneralController,
    AdminController,
    PageController,
    FileManagerController,
    UserController,
    SystemAuthorizationController,
    PostController,
    PostCommentController,
    PostCategoryController,
    VisitorInfoController
};

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/login', [LoginController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');

    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/password/update', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
});

/*
|--------------------------------------------------------------------------
| Admin Logout (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| System / Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'system', 'middleware' => ['auth:admin']], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('system.dashboard');
    Route::post('/site/status', [DashboardController::class, 'site_status'])->name('site.status');
    // General Settings
    Route::get('/general', [GeneralController::class, 'index'])->name('system.general');
    Route::post('/general/update', [GeneralController::class, 'update'])->name('system.general.update');
    // File Manager
    Route::get('/filemanager', [FileManagerController::class, 'index'])->name('filemanager');
    Route::post('/filemanager/upload', [FileManagerController::class, 'upload_file'])->name('file.upload');
    Route::post('/filemanager/folder/create', [FileManagerController::class, 'create_folder'])->name('create.folder');
    Route::post('/filemanager/delete', [FileManagerController::class, 'delete'])->name('delete.file.folder');

    // Admin Management
    Route::resource('administration', AdminController::class)->names([
        'index'   => 'system.administration',
        'store'   => 'system.administration.store',
        'update'  => 'system.administration.update',
        'destroy' => 'system.administration.delete',
    ])->except(['show', 'create']);
    Route::post('administration/edit', [AdminController::class, 'edit'])->name('system.administration.edit');


    // Users
    Route::resource('user', UserController::class)->only(['index', 'destroy'])->names([
        'index'   => 'system.user',
        'destroy' => 'system.user.delete',
    ]);

    // Pages
    Route::resource('page', PageController::class)->names([
        'index'   => 'system.page',
        'create'  => 'system.page.create',
        'store'   => 'system.page.store',
        'edit'    => 'system.page.edit',
        'update'  => 'system.page.update',
        'destroy' => 'system.page.delete',
    ])->except(['show']);

    // Authorization
    Route::resource('authorization', SystemAuthorizationController::class)->names([
        'index'   => 'system.authorization',
        'store'   => 'system.authorization.store',
        'update'  => 'system.authorization.update',
        'destroy' => 'system.authorization.delete',
    ])->except(['create', 'show', 'edit']);
    Route::post('authorization/edit',[SystemAuthorizationController::class, 'edit'])->name('system.authorization.edit');
    Route::post('authorization/update-role',[SystemAuthorizationController::class, 'role_update'])->name('system.authorization.role.update');
    
    // Post
    Route::resource('post', PostController::class)->names([
        'index'   => 'system.post',
        'create'  => 'system.post.create',
        'store'   => 'system.post.store',
        'edit'    => 'system.post.edit',
        'update'  => 'system.post.update',
        'destroy' => 'system.post.delete',
    ])->except(['show']);

    // Categories
    Route::resource('post/category', PostCategoryController::class)->names([
        'index'  => 'system.post.category',
        'create'  => 'system.post.category.create',
        'store'   => 'system.post.category.store',
        'edit'    => 'system.post.category.edit',
        'update'  => 'system.post.category.update',
        'destroy' => 'system.post.category.delete',
    ])->except(['show']);

    // Post Comments
    Route::resource('post/comment', PostCommentController::class)->only(['index', 'store', 'destroy'])->names([
        'index'   => 'system.post.comments.list',
        'store'   => 'system.post.comment.store',
        'destroy' => 'system.post.comment.delete',
    ]);           
    Route::get('post/{id}/comment',[PostCommentController::class, 'show'])->name('system.post.comments.show');

    // Visitor information
    Route::get('/visitor-info/{type}', [VisitorInfoController::class, 'index'])->name('system.visitor.info');
});