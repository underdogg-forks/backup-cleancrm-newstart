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


Route::group(['prefix' => 'hrm', 'middleware' => 'web', 'namespace' => 'Modules\Hrm\Controllers'],
    function () {
        Route::get('/', 'Modules\Hrm\Controllers\EmployeesController@admincp')->name('employees.dashboard');
        Route::resource('employees', 'EmployeesController');
    });


Route::group(['prefix' => 'api', 'middleware' => 'web', 'namespace' => 'Modules\Hrm\Controllers'], function () {
    Route::get('employeesdata', ['as' => 'api.employees.data', 'uses' => 'RolesController@anyData']);
}); // End of ADMIN group
