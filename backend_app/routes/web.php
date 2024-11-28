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
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@checkAdmin');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    Route::group(['middleware' => 'auth', 'admin'], function () {
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('form', 'DashboardController@form')->name('form');

        //Role
        Route::resource('roles', 'RoleController')->middleware('cms:resource');
        Route::post('permissions/update_batch', 'PermissionController@update')->name('permissions.update_batch');
        Route::get('permissions/sync', 'PermissionController@sync')->name('permissions.sync');
        Route::post('permissions/update_title', 'PermissionController@updateTitle')->name('permissions.update_title');
        Route::resource('permissions', 'PermissionController')->middleware('cms:resource');

        //User
        Route::resource('users', 'UserController')->middleware('cms:resource');

    });
});


