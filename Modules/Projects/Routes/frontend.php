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


Route::group(['middleware' => 'web', 'namespace' => 'Modules\Core\Controllers'], function () {
    Route::get('/', 'FrontendHomeController@welcome')->name('welcome');
});

//});