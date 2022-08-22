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

    Route::get('mrabp/data/{id}', array('uses' => 'MrabpController@data'));
    Route::get('mrabp/settermin/{id}', array('uses' => 'MrabpController@settermin')); 
    Route::post('mrabp/setterminsimpan', array('before' => 'csrf', 'uses' => 'MrabpController@setterminsave'));  
	Route::get('mrabp/rabm/{id}', array('uses' => 'MrabpController@rabm'));  	
    Route::get('mrabp/view/{id}', array('uses' => 'MrabpController@view'));  	
    Route::post('mrabp/rabm/simpan', array('before' => 'csrf', 'uses' => 'MrabpController@rabmsimpan'));  
    Route::get('mrabp/add/{id}', array('uses' => 'MrabpController@add'));  
    Route::get('mrabp/ubah/{id}', array('uses' => 'MrabpController@ubah'));
    Route::post('mrabp/ubah/simpan', array('before' => 'csrf', 'uses' => 'MrabpController@ubahsimpan'));  
    Route::get('mrabp/ajukan/{id_properti}/{id}', array('uses' => 'MrabpController@ajukan'));
    Route::post('mrabp/unitdetail', array('before' => 'csrf', 'uses' => 'MrabpController@unitdetail'));  
    
    Route::resource('mrabp', 'MrabpController');


});
  