<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\AuthController;
use App\Admin\Controllers\UserController;
use Encore\Admin\Facades\Admin;

Route::group(['prefix' => config('admin.route.prefix'), 'middleware' => config('admin.route.middleware')], function () {
  Route::get('auth/login', [AuthController::class, 'getLogin'])->name('admin.login');
  Route::post('auth/login', [AuthController::class, 'postLogin']);
  Route::get('auth/logout', [AuthController::class, 'getLogout'])->name('admin.logout');
});

Admin::registerAuthRoutes();

Route::get('/', 'HomeController@index');

Route::resource('users', UserController::class);
