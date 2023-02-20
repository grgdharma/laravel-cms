<?php 

Route::group(['namespace' => 'Frontend'], function () {

	Route::get('/', 'FrontendController@index')->name('home');
	Route::get('/demo', 'FrontendController@demo')->name('demo');
	Route::get('/page/{slug}', 'FrontendController@page_detail')->name('page.detail');
	Route::get('/blog/category/{slug}', 'FrontendController@postByCategory')->name('category.post');
	Route::get('/blog/{slug}', 'FrontendController@post_detail')->name('post.detail');
});