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

Route::group(['middleware' => ['web']], function () {
    // Authentication Routes...
    Route::get('login', ['uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm', 'as' => 'session.login']);
    Route::post('login', ['uses' => 'App\Http\Controllers\Auth\LoginController@login', 'as' => 'login']);
    Route::get('getlogout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout', 'as' => 'session.logout']);
    Route::post('logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout', 'as' => 'session.logout']);

    // Registration Routes...
    Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

//'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkPasswordRequestForm', 'as' => 'password . request'


    // Password Reset Routes...
    Route::get('password/request', [
        'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkPasswordRequestForm',
        'as' => 'password.request'
    ]);
    Route::get('password / reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password / email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password / reset /{
        token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm');
    Route::post('password / reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
});
