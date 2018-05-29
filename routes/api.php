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

    // Users Routes
    Route::resource('users', 'Api\v1\UserController');
    Route::get('user', 'Api\v1\UserController@userInfo')->name('users.userInfo');

    // Project Routes
    Route::resource('projects', 'Api\v1\ProjectsController');
    Route::get('project/{id}/next', 'Api\v1\ProjectsController@getNextProject')->name('projects.getNextProject');
    Route::get('project/{slug}', 'Api\v1\ProjectsController@showBySlug')->name('project.bySlug');

    // Areas for Projects
    Route::resource('areas', 'Api\v1\AreasController');

    // Configuration ?
    Route::get('getConfigModels', 'Api\v1\ProjectsController@getConfigModels')->name('project.configModels');

    // Apply to a position vacancy
    Route::post('apply', 'Api\v1\ProfileController@store')->name('apply');

    // Thanks for sending us your data
    Route::get('thanks-gif', 'Api\v1\PositionsController@thanks')->name('thanks');

    //Positions API Group
    Route::get('positions/{position}', 'Api\v1\PositionsController@show');

});
