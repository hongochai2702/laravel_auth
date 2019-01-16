<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
	Route::get('/approval', 'HomeController@approval')->name('approval');

	Route::middleware(['approved'])->group(function() {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/users/edit/{user_id}', 'UserController@show_edit')->name('admin.users.show_edit');
	});

	Route::middleware(['admin'])->group(function() {
		Route::get('/users', 'UserController@index')->name('admin.users.index');
		Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
		Route::post('/users/post_edit/{user_id}', 'UserController@post_edit')->name('admin.users.post_edit');
	});
});
