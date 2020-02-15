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
    Route::get('/','Admin\AdminController@index')->name('admin.index');

    Route::prefix('teachers')->group(function (){
        Route::get('/','Admin\TeacherController@index')->name('admin.teacher.index');
        Route::get('/create','Admin\TeacherController@create')->name('admin.teacher.create');
        Route::get('/{id}/show','Admin\TeacherController@show')->name('admin.teacher.show');
        Route::get('/{id}/edit','Admin\TeacherController@edit')->name('admin.teacher.edit');

        Route::put('/{id}/update','Admin\TeacherController@update')->name('admin.teacher.update');
        Route::post('/store','Admin\TeacherController@store')->name('admin.teacher.store');
        Route::delete('/{id}/destroy','Admin\TeacherController@destroy')->name('admin.teacher.destroy');
    });

    Route::prefix('modules')->group(function (){
        Route::get('/','Admin\ModuleController@index')->name('admin.module.index');
        Route::get('/create','Admin\ModuleController@create')->name('admin.module.create');
        Route::get('/{id}/show','Admin\ModuleController@show')->name('admin.module.show');
        Route::get('/{id}/edit','Admin\ModuleController@edit')->name('admin.module.edit');

        Route::put('/{id}/update','Admin\ModuleController@update')->name('admin.module.update');
        Route::post('/store','Admin\ModuleController@store')->name('admin.module.store');
        Route::delete('/{id}/destroy','Admin\ModuleController@destroy')->name('admin.module.destroy');
    });


});


