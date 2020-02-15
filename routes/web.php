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


/**
 * Routes for guests
 */
Route::get('/','GuestController@index')->name('guest.index');


/**
 * Routes for admin
 */
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

    Route::prefix('users')->group(function (){
        Route::get('/','Admin\UserController@index')->name('admin.user.index');
        Route::get('/create','Admin\UserController@create')->name('admin.user.create');
        Route::get('/{id}/show','Admin\UserController@show')->name('admin.user.show');
        Route::get('/{id}/edit','Admin\UserController@edit')->name('admin.user.edit');

        Route::put('/{id}/update','Admin\UserController@update')->name('admin.user.update');
        Route::post('/store','Admin\UserController@store')->name('admin.user.store');
        Route::delete('/{id}/destroy','Admin\UserController@destroy')->name('admin.user.destroy');
    });

    Route::prefix('roles')->group(function (){
        Route::get('/','Admin\RoleController@index')->name('admin.role.index');
        Route::get('/create','Admin\RoleController@create')->name('admin.role.create');
        Route::get('/{id}/show','Admin\RoleController@show')->name('admin.role.show');
        Route::get('/{id}/edit','Admin\RoleController@edit')->name('admin.role.edit');

        Route::put('/{id}/update','Admin\RoleController@update')->name('admin.role.update');
        Route::post('/store','Admin\RoleController@store')->name('admin.role.store');
        Route::delete('/{id}/destroy','Admin\RoleController@destroy')->name('admin.role.destroy');
    });

    Route::prefix('permissions')->group(function (){
        Route::get('/','Admin\PermissionController@index')->name('admin.permission.index');
        Route::get('/create','Admin\PermissionController@create')->name('admin.permission.create');
        Route::get('/{id}/show','Admin\PermissionController@show')->name('admin.permission.show');
        Route::get('/{id}/edit','Admin\PermissionController@edit')->name('admin.permission.edit');

        Route::put('/{id}/update','Admin\PermissionController@update')->name('admin.permission.update');
        Route::post('/store','Admin\PermissionController@store')->name('admin.permission.store');
        Route::delete('/{id}/destroy','Admin\PermissionController@destroy')->name('admin.permission.destroy');
    });


});


