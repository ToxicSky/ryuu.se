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

Route::get('/home', function () {
    return view('home');
});

Route::get('/', 'PostController@index')->name('home');

Auth::routes();

// Posts: ----------------------------------------------

Route::group(
    ['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'],
    function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::resource('posts', 'Admin\PostController');
        Route::resource('users', 'Admin\UserController');
    }
);

Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController');
Route::resource('comment', 'CommentController');
