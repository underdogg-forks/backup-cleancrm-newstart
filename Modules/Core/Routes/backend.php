<?php

/**
 * InvoicePlane
 *
 * @package     InvoicePlane
 * @author      InvoicePlane Developers & Contributors
 * @copyright   Copyright (C) 2014 - 2018 InvoicePlane
 * @license     https://invoiceplane.com/license
 * @link        https://invoiceplane.com
 *
 * Based on FusionInvoice by Jesse Terry (FusionInvoice, LLC)
 */

// Administrator & owner Control Panel Routes
//'middleware' => ['role:administrator|owner']


//Route::group([], function () {

//'middleware' => ['role:administrator|owner']


Route::group(['prefix' => 'admincp', 'middleware' => 'web', 'namespace' => 'Modules\Core\Controllers\AdminCP'],
    function () {


// Dashboard
//Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('/', '\Modules\Core\Controllers\AdminCP\HomeController@admincp')->name('admincp');
        //Route::get('/', ['uses' => 'AdminCPController@index', 'as' => 'dashboard.index']);
        Route::get('dashboard', ['uses' => 'HomeController@index', 'as' => 'dashboard.index']);

        Route::get('permissions', ['uses' => 'PermissionsController@index', 'as' => 'permissions.index']);


        Route::resource('users', 'UsersController');
        Route::resource('permissions', 'PermissionsController');
        Route::resource('roles', 'RolesController');
    });


Route::group(['prefix' => 'api', 'middleware' => 'web', 'namespace' => 'Modules\Core\Controllers\AdminCP'], function () {
    Route::get('relationsdata', ['as' => 'api.roles.data', 'uses' => 'RolesController@anyData']);

}); // End of ADMIN group


//});