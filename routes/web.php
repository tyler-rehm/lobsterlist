<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');
Route::get('/contact', 'ContactController@index');
Route::get('/contact/privacy/toggle/{id}', 'ContactController@privacy_toggle');
Route::get('/contact/view/{id}', 'ContactController@view');
Route::get('/contact/delete/{id}', 'ContactController@delete');
Route::post('/contact/import', 'ContactController@import');
Route::get('/export/{file_name}', 'ContactController@export');
