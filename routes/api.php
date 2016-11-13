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
    'middleware' => 'auth:api'
], function () {
    Route::post('/contact/add', 'ContactController@add');
    Route::post('/contact/import', 'ContactController@import');
    Route::post('/contact/export', 'ContactController@export');
    Route::post('/reminder/add', 'ReminderController@add');
});
