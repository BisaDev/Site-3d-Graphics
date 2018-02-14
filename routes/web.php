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

// Admin routes. Any route that starts with Admin will be handled by the admin vue-router
Route::view('{admin}', 'admin-app')->where('admin', 'admin.*')->middleware('auth');

// Site routes. Any route except for admin and auth routes will be handled by the site vue-router
Route::view('{site}', 'site-app')->where('site', '^(?!(login|logout|admin|register)).*');

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    Session::flush();

    return Redirect::to('/');
});
