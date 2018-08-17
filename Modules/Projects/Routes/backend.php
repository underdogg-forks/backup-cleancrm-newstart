<?php

Route::group(['prefix' => 'admincp', 'middleware' => 'web', 'namespace' => 'Modules\Projects\Controllers'],
    function () {

        Route::get('/projects/', '\Modules\Projects\Controllers\AdminCP\ProjectsController@admincp')->name('projects.admincp');
        //Route::get('/', ['uses' => 'AdminCPController@index', 'as' => 'dashboard.index']);
        //Route::get('dashboard', ['uses' => 'HomeController@index', 'as' => 'dashboard.index']);
        Route::resource('projects', 'ProjectsController');
    });


Route::group(['prefix' => 'api', 'middleware' => 'web', 'namespace' => 'Modules\Projects\Controllers'], function () {
    Route::get('projectsdata', ['as' => 'api.projects.data', 'uses' => 'ProjectsController@anyData']);
}); // End of ADMIN group
