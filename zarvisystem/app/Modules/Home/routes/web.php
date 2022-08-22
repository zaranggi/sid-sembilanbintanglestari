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


Route::group([ 'middleware' => ['web','auth'], ], function() {

    Route::resource('home', 'HomeController');
    Route::get('home/data/{id}', 'HomeController@data'); 
    Route::resource('/', 'HomeController');

});

