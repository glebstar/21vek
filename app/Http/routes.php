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

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/admin', 'AdminHomeController@index');
    Route::get('/admin/addobject', 'AdminHomeController@addObject');
    Route::post('/admin/addobject', 'AdminHomeController@addObjectPost');
});

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/prodaja-kvartir-v-ulan-ude', 'HomeController@index');
Route::get('/prodaja-domov-v-ulan-ude', 'HomeController@index');
Route::get('/prodaja-komnat-v-ulan-ude', 'HomeController@index');
Route::get('/prodaja-uchastkov-v-ulan-ude', 'HomeController@index');

Route::get('/prodaja-kvartir-v-ulan-ude/{id}', 'HomeController@object');
Route::get('/prodaja-domov-v-ulan-ude/{id}', 'HomeController@object');
Route::get('/prodaja-komnat-v-ulan-ude/{id}', 'HomeController@object');
Route::get('/prodaja-uchastkov-v-ulan-ude/{id}', 'HomeController@object');


