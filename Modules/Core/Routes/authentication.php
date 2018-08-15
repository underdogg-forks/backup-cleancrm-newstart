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
    Route::get('login', ['uses' => 'Modules\Core\Controllers\Auth\LoginController@showLoginForm', 'as' => 'session.login']);
    Route::post('login', ['uses' => 'Modules\Core\Controllers\Auth\LoginController@login', 'as' => 'login']);
    Route::get('getlogout', ['uses' => 'Modules\Core\Controllers\Auth\LoginController@logout', 'as' => 'session.getlogout']);
    Route::post('logout', ['uses' => 'Modules\Core\Controllers\Auth\LoginController@logout', 'as' => 'session.logout']);

    // Registration Routes...
    Route::get('register', 'Modules\Core\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Modules\Core\Controllers\Auth\RegisterController@register');

//'uses' => 'Modules\Core\Controllers\Auth\ForgotPasswordController@showLinkPasswordRequestForm', 'as' => 'password . request'


    // Password Reset Routes...
    Route::get('password/request', [
        'uses' => 'Modules\Core\Controllers\Auth\ForgotPasswordController@showLinkPasswordRequestForm',
        'as' => 'password.request'
    ]);
    Route::get('password / reset', 'Modules\Core\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password / email', 'Modules\Core\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password / reset /{
        token}', 'Modules\Core\Controllers\Auth\ResetPasswordController@showResetForm');
    Route::post('password / reset', 'Modules\Core\Controllers\Auth\ResetPasswordController@reset');
});
