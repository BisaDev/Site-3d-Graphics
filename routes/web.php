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
Route::view('{admin}', 'admin-app')->where('admin', 'admin.*')->middleware('auth');
Route::view('{site}', 'site-app')->where('site', '^(?!(login|logout|admin|register)).*');

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    Session::flush();

    return Redirect::to('/');
});
