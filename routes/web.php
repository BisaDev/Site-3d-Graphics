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

// Routing is handled by Vue Router, see: resources/assets/js/router.js
//Route::view('{admin}', 'admin-app')->where('admin', 'admin.*')->middleware('auth:api');
//Auth::routes();
//Route::view('{login}', 'admin-app')->where('login', 'login.*')->name('login')->middleware('auth:api');
//Route::get('/login', function () {})->name('login');

Route::view('login', 'admin-app')->name('login');
Route::view('{site}', 'site-app')->where('site', '^(?!(login|logout|admin|register|auth/logout)).*');

Route::/*middleware('auth:api')->*/name('admin')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin-app');
    });

    Route::view('{projects}', 'admin-app')->where('projects', '^projects.*');

    /*
    Route::get('projects', function () {
        return view('admin-app');
        // Matches The "/admin/users" URL
    });
    */

    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });
});

Route::view('logout', 'admin-app')->name('logout');

/**
 * API Authentication Routes
 */
Route::post('auth/token', 'Api\Auth\AuthController@authenticate')->middleware('api');
Route::post('auth/refresh', 'Api\Auth\AuthController@refreshToken')->middleware('api');

Route::get('auth/logout', function () {
    $value = request()->bearerToken();
    $id = (new \Lcobucci\JWT\Parser())->parse($value)->getHeader('jti');
    DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => 1]); //revoked tokens

    return Response([
        'code' => 200,
        'message' => 'You are successfully logged out',
    ], 200);
});