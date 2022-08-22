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
    Route::post('materialmasuk/simpan', array('before' => 'csrf', 'uses' => 'MaterialmasukController@simpan')); 
	Route::get('materialmasuk/terima/{docno}/{pembayaran}', array('uses' => 'MaterialmasukController@terima')); 	
    Route::resource('materialmasuk', 'MaterialmasukController');

});

 