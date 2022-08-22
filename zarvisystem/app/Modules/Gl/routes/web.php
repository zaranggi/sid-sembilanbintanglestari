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
    Route::get('gl/preview2/{id_properti}/{id}/{tanggal1}/{tanggal2}', array('before' => 'csrf', 'uses' => 'GlController@datanya'));  
    Route::post('gl/preview', array('before' => 'csrf', 'uses' => 'GlController@preview'));  
    Route::post('gl/datanya', array('before' => 'csrf', 'uses' => 'GlController@datanya'));  
    Route::resource('gl', 'GlController');

});  
 