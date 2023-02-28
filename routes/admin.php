<?php 

Route::group(['prefix' => 'admin','namespace' => 'Auth\Admin'], function () {
    
	Route::get('/login', 'LoginController@showLogin')->name('admin.login');
	Route::post('/login', 'LoginController@login')->name('admin.login.submit');

	Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}/{email}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/update', 'ResetPasswordController@reset')->name('admin.password.update');

});

Route::group(['prefix' => 'admin','middleware' => ['auth:admin'], 'namespace' => 'Auth\Admin'], function () {
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'system','middleware' => ['auth:admin'], 'namespace' => 'Admin'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('system.dashboard');
    Route::post('/site/status', 'DashboardController@site_status')->name('site.status');
    // General
    Route::get('/general', 'GeneralController@index')->name('system.general');
    Route::post('/general/update', 'GeneralController@update')->name('system.general.update');

    // Admin Manager
    Route::get('/administration', 'AdminController@index')->name('system.administration');
    Route::post('/administration/store', 'AdminController@store')->name('system.administration.store');
    Route::post('/administration/edit', 'AdminController@edit')->name('system.administration.edit');
    Route::post('/administration/{id}/update', 'AdminController@update')->name('system.administration.update');
    Route::delete('/administration/{id}/delete', 'AdminController@destroy')->name('system.administration.delete');

    // Pages
    Route::get('/page', 'PageController@index')->name('system.page');
    Route::get('/create/page', 'PageController@create')->name('system.page.create');
    Route::post('/page/store', 'PageController@store')->name('system.page.store');
    Route::get('/edit/{id}/page', 'PageController@edit')->name('system.page.edit');
    Route::post('/page/{id}/update', 'PageController@update')->name('system.page.update');
    Route::delete('/page/{id}/delete', 'PageController@destroy')->name('system.page.delete');

    // File manager
    Route::get('/filemanager', 'FileManagerController@index')->name('filemanager');
    Route::post('/filemanager/upload', 'FileManagerController@upload_file')->name('file.upload');
    Route::post('/filemanager/folder/create', 'FileManagerController@create_folder')->name('create.folder');
    Route::post('/filemanager/delete', 'FileManagerController@delete')->name('delete.file.folder');

    // Users
    Route::get('/user', 'UserController@index')->name('system.user');
    Route::delete('/user/{id}/delete', 'UserController@destroy')->name('system.user.delete');

    // System Authorization
    Route::get('/authorization', 'SystemAuthorizationController@index')->name('system.authorization');
    Route::post('/authorization/store', 'SystemAuthorizationController@store')->name('system.authorization.store');
    Route::post('/authorization/edit', 'SystemAuthorizationController@edit')->name('system.authorization.edit');
    Route::post('/authorization/{id}/update', 'SystemAuthorizationController@update')->name('system.authorization.update');
    Route::post('/authorization/update', 'SystemAuthorizationController@role_update')->name('system.authorization.role.update');
    Route::delete('/authorization/{id}/delete', 'SystemAuthorizationController@destroy')->name('system.authorization.delete');
    // Post
    Route::get('/post', 'PostController@index')->name('system.post');
    Route::get('/create/post', 'PostController@create')->name('system.post.create');
    Route::post('post/store', 'PostController@store')->name('system.post.store');
    Route::get('/edit/{id}/post', 'PostController@edit')->name('system.post.edit');
    Route::post('/post/{id}/update', 'PostController@update')->name('system.post.update');
    Route::delete('/post/{id}/delete', 'PostController@destroy')->name('system.post.delete');
    // Post comment
    Route::get('/post/comment', 'PostCommentController@index')->name('system.post.comments.list');
    Route::get('/post/detail/{id}/comment', 'PostCommentController@show')->name('system.post.comments.show');
    Route::post('/post/comment/store', 'PostCommentController@store')->name('system.post.comment.store');
    Route::delete('/post/comment/{id}/delete', 'PostCommentController@destroy')->name('system.post.comment.delete');

    // Categories
    Route::get('/post/category', 'PostCategoryController@index')->name('system.post.category');
    Route::get('/post/create/category', 'PostCategoryController@create')->name('system.post.category.create');
    Route::post('/post/category/store', 'PostCategoryController@store')->name('system.post.category.store');
    Route::get('/post/edit/{id}/category', 'PostCategoryController@edit')->name('system.post.category.edit');
    Route::post('/post/category/{id}/update', 'PostCategoryController@update')->name('system.post.category.update');
    Route::delete('/post/category/{id}/delete', 'PostCategoryController@destroy')->name('system.post.category.delete');
    // Visitor information
    Route::get('/visitor-info/{type}', 'VisitorInfoController@index')->name('system.visitor.info');
});