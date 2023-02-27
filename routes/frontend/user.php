<?php 

Route::group(['prefix' => 'verification','namespace' => 'Auth'], function () {
    Route::get('/', 'RegisterController@showVerificationForm')->name('verification.form');
    Route::post('/verification/confirm', 'RegisterController@verification_confirm')->name('verification.confirm');
});

Route::group(['prefix' => 'user','middleware' => ['auth'],], function () {
    Route::get('/dashboard', 'HomeController@index')->name('user.dashboard');
    Route::get('/edit', 'HomeController@edit_profile')->name('user.dashboard.edit');
    Route::post('/{id}/update', 'HomeController@update')->name('user.dashboard.update');

    // File manager
    Route::get('/filemanager', 'User\FileManagerController@index')->name('user.filemanager');
    Route::post('/filemanager/upload', 'User\FileManagerController@upload_file')->name('user.file.upload');
    Route::post('/filemanager/folder/create', 'User\FileManagerController@create_folder')->name('user.create.folder');
    Route::post('/filemanager/delete', 'User\FileManagerController@delete')->name('user.delete.file.folder');
    // Post Comment
    Route::post('/comment/store', 'User\PostCommentController@store')->name('user.comment.store');
});