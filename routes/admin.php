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

Route::group(['prefix' => 'admin','middleware' => ['auth:admin'], 'namespace' => 'Admin'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::post('/site/status', 'DashboardController@site_status')->name('site.status');
    // General
    Route::get('/general', 'GeneralController@index')->name('admin.general');
    Route::post('/general/update', 'GeneralController@update')->name('admin.general.update');

    // Admin Manager
    Route::get('/system/administration', 'AdminController@index')->name('admin.dashboard.administration');
    Route::post('/system/administration/store', 'AdminController@store')->name('admin.dashboard.administration.store');
    Route::post('/system/administration/edit', 'AdminController@edit')->name('admin.dashboard.administration.edit');
    Route::post('/system/administration/{id}/update', 'AdminController@update')->name('admin.dashboard.administration.update');
    Route::delete('/system/administration/{id}/delete', 'AdminController@destroy')->name('admin.dashboard.administration.delete');

    // Pages
    Route::get('/catalog/page', 'PageController@index')->name('admin.catalog.page');
    Route::get('/catalog/create/page', 'PageController@create')->name('admin.catalog.page.create');
    Route::post('/catalog/page/store', 'PageController@store')->name('admin.catalog.page.store');
    Route::get('/catalog/edit/{id}/page', 'PageController@edit')->name('admin.catalog.page.edit');
    Route::post('/catalog/page/{id}/update', 'PageController@update')->name('admin.catalog.page.update');
    Route::delete('/catalog/page/{id}/delete', 'PageController@destroy')->name('admin.catalog.page.delete');

    // File manager
    Route::get('/filemanager', 'FileManagerController@index')->name('filemanager');
    Route::post('/filemanager/upload', 'FileManagerController@upload_file')->name('file.upload');
    Route::post('/filemanager/folder/create', 'FileManagerController@create_folder')->name('create.folder');
    Route::post('/filemanager/delete', 'FileManagerController@delete')->name('delete.file.folder');

    // Users
    Route::get('/system/user', 'UserController@index')->name('admin.dashboard.user');
    Route::delete('/system/user/{id}/delete', 'UserController@destroy')->name('admin.dashboard.user.delete');

    // System Permission
    Route::get('/system/permission', 'SystemPermissionController@index')->name('admin.dashboard.permission');
    Route::post('/system/permission/store', 'SystemPermissionController@store')->name('admin.dashboard.permission.store');
    Route::post('/system/permission/edit', 'SystemPermissionController@edit')->name('admin.dashboard.permission.edit');
    Route::post('/system/permission/{id}/update', 'SystemPermissionController@update')->name('admin.dashboard.permission.update');
    Route::post('/system/permission/update', 'SystemPermissionController@role_update')->name('admin.dashboard.permission.role.update');
    Route::delete('/system/permission/{id}/delete', 'SystemPermissionController@destroy')->name('admin.dashboard.permission.delete');
    // Post
    Route::get('/post', 'PostController@index')->name('admin.post');
    Route::get('/create/post', 'PostController@create')->name('admin.post.create');
    Route::post('post/store', 'PostController@store')->name('admin.post.store');
    Route::get('/edit/{id}/post', 'PostController@edit')->name('admin.post.edit');
    Route::post('/post/{id}/update', 'PostController@update')->name('admin.post.update');
    Route::delete('/post/{id}/delete', 'PostController@destroy')->name('admin.post.delete');
    // Post comment
    Route::get('/comment', 'PostCommentController@index')->name('comments.list');
    Route::get('/detail/{id}/comment', 'PostCommentController@show')->name('comments.show');
    Route::post('/comment/store', 'PostCommentController@store')->name('comment.store');

    // Categories
    Route::get('/category', 'PostCategoryController@index')->name('admin.post.category');
    Route::get('/create/category', 'PostCategoryController@create')->name('admin.post.category.create');
    Route::post('/category/store', 'PostCategoryController@store')->name('admin.post.category.store');
    Route::get('/edit/{id}/category', 'PostCategoryController@edit')->name('admin.post.category.edit');
    Route::post('/category/{id}/update', 'PostCategoryController@update')->name('admin.post.category.update');
    Route::delete('/category/{id}/delete', 'PostCategoryController@destroy')->name('admin.post.category.delete');
    // Visitor information
    Route::get('/visitor-info/{type}', 'VisitorInfoController@index')->name('visitor.info');
});