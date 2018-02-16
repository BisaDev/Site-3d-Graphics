<?php

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

Route::name('api')->prefix('v1')->group(function () {
    Route::resource('users', 'Api\v1\UserController');
    Route::get('user', 'Api\v1\UserController@userInfo')->name('users.userInfo');
    Route::resource('projects', 'Api\v1\ProjectsController');
    Route::get('project/{id}/next', 'Api\v1\ProjectsController@getNextProject')->name('projects.getNextProject');
});
