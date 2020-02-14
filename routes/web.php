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
Auth::routes(['register' => false]);

/**
 * Google OAuth Login
 */
Route::get('/google/redirect','Auth\LoginController@redirectToGoogle')->name('google.redirect');
Route::get('/google/callback','Auth\LoginController@handleGoogleCallback')->name('google.callback');

Route::get('/','GuestController@index')->name('guest.index');

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/', function (){ return redirect()->route('admin.dashboard.index'); });
    Route::get('/dashboard','Admin\AdminController@index')->name('admin.dashboard.index');
});


