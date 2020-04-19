<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'namespace' => 'Api\V1' ,
    'prefix' => 'v1',
    'middleware' => 'auth:api'
], function () {

    Route::apiResources([
        'project' => 'ProjectController',
        'task' => 'TaskController'
    ]);

    Route::get('project/{project}/task', 'ProjectTaskController@projectTask');
});

