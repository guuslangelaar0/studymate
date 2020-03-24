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
Route::get('/google/redirect','Auth\OAuth\GoogleController@redirectToGoogle')->name('google.redirect');
Route::get('/google/callback','Auth\OAuth\GoogleController@handleGoogleCallback')->name('google.callback');
Route::get('/google/disconnect','Auth\OAuth\GoogleController@disconnect')->name('google.disconnect');


/**
 * Routes for guests
 */
Route::get('/','GuestController@index')->name('guest.index');
Route::get('/inzien/{id}','GuestController@user')->name('guest.user');


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


        Route::get('/{module_id}/exams','Admin\ExamController@index')->name('admin.module.exam.index');
        Route::get('/{module_id}/exams/create','Admin\ExamController@create')->name('admin.module.exam.create');
        Route::get('/exams/{id}/edit','Admin\ExamController@edit')->name('admin.module.exam.edit');

        Route::put('/exams/{id}/update','Admin\ExamController@update')->name('admin.module.exam.update');
        Route::post('/exams/store','Admin\ExamController@store')->name('admin.module.exam.store');
        Route::delete('/exams/{id}/destroy','Admin\ExamController@destroy')->name('admin.module.exam.destroy');

    });

    Route::prefix('users')->group(function (){
        Route::get('/','Admin\UserController@index')->name('admin.user.index');
        Route::get('/create','Admin\UserController@create')->name('admin.user.create');
        Route::get('/{id}/show','Admin\UserController@show')->name('admin.user.show');
        Route::get('/{id}/edit','Admin\UserController@edit')->name('admin.user.edit');

        Route::put('/{id}/update','Admin\UserController@update')->name('admin.user.update');
        Route::post('/store','Admin\UserController@store')->name('admin.user.store');
        Route::delete('/{id}/destroy','Admin\UserController@destroy')->name('admin.user.destroy');

        Route::post('/{id}/loginAsUser','Admin\UserController@loginAsUser')->name('admin.user.loginAsUser');
        Route::post('/returnToOwnUser','Admin\UserController@returnToOwnUser')->name('admin.user.returnToOwnUser');
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

    Route::prefix('deadline-manager')->group(function () {
        Route::get('/','DM\DMController@index')->name('admin.dm.index');

        Route::get('/exam/{id}/edit','DM\DMController@edit')->name('admin.dm.exam.edit');

        Route::put('/exam/{id}/update','DM\DMController@update')->name('admin.dm.exam.update');

        Route::post('/{id}/enroll', 'DM\DMController@enroll')->name('admin.dm.enroll');
        Route::delete('/{id}/unroll', 'DM\DMController@disenroll')->name('admin.dm.unenroll');

        Route::put('/user-exams/{id}/update','DM\DMController@updateUserExam')->name('admin.dm.user-exam.update');

        Route::post("/{id}/enroll/exam", "DM\DMController@enrollExam")->name('admin.dm.enroll_exam');
        Route::delete("/{id}/unroll/exam", "DM\DMController@unenrollExam")->name('admin.dm.unenroll_exam');
    });

    Route::prefix('account')->group(function () {
        Route::get('/','Admin\AccountController@index')->name('admin.account.index');
        Route::get('/edit','Admin\AccountController@edit')->name('admin.account.edit');

        Route::put('/update','Admin\AccountController@update')->name('admin.account.update');

    });
});


