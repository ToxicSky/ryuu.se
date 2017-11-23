<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('route/{name}', 'API\RouteController@index');
Route::group(['as' => 'api.'], function () {
    Route::resource('posts', 'API\PostController');
    Route::resource('comments', 'API\CommentController');
    Route::resource('categories', 'API\CategoryController');

    Route::get(
        'tags/most-used', 'API\TagController@mostUsed'
    )->name('tags.most_used');
});
