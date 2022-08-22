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

Route::group([ 'middleware' => ['web','auth'] ], function() {
	Route::post('bast/simpan', array('before' => 'csrf', 'uses' => 'BastController@simpan')); 
    Route::get('bast/listall/{id}', array('uses' => 'BastController@listall')); 
    Route::resource('bast', 'BastController');

});
  