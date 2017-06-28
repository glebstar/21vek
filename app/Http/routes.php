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

    Route::get('/admin/editobject/{id}', 'AdminHomeController@editObject');
    Route::post('/admin/editobject', 'AdminHomeController@editObjectPost');

    Route::post('/admin/addimage', 'AdminHomeController@addImage');
    Route::post('/admin/delimage', 'AdminHomeController@delImage');

    Route::get('/admin/archive', 'AdminHomeController@archive');

    Route::post('/admin/toarchive', 'AdminHomeController@toArchiveObject');
    Route::post('/admin/fromarchive', 'AdminHomeController@fromArchiveObject');

    Route::get('/admin/feed', 'AdminHomeController@feed');
    Route::get('/admin/feed/gen', 'AdminHomeController@feedGen');

    Route::get('/admin/cms/about', 'AdminCmsController@about');
    Route::post('/admin/cms/about', 'AdminCmsController@aboutPost');

    Route::get('/admin/cms/contact', 'AdminCmsController@contact');
    Route::post('/admin/cms/contact', 'AdminCmsController@contactPost');
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

Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::get('/aaa', function (){
    //Artisan::call('genfeed');
});
