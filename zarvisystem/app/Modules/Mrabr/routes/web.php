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

    Route::get('mrabr/data/{id}', array('uses' => 'MrabrController@data'));
    Route::get('mrabr/settermin/{id}', array('uses' => 'MrabrController@settermin')); 
    Route::post('mrabr/setterminsimpan', array('before' => 'csrf', 'uses' => 'MrabrController@setterminsave'));  
	Route::get('mrabr/rabm/{id}', array('uses' => 'MrabrController@rabm'));  	
    Route::get('mrabr/view/{id}', array('uses' => 'MrabrController@view'));  	
    Route::post('mrabr/rabm/simpan', array('before' => 'csrf', 'uses' => 'MrabrController@rabmsimpan'));  
    Route::get('mrabr/add/{id}', array('uses' => 'MrabrController@add'));  
    Route::get('mrabr/ubah/{id}', array('uses' => 'MrabrController@ubah'));
    Route::post('mrabr/ubah/simpan', array('before' => 'csrf', 'uses' => 'MrabrController@ubahsimpan'));  
    Route::get('mrabr/ajukan/{id_properti}/{id}', array('uses' => 'MrabrController@ajukan'));
    Route::post('mrabr/unitdetail', array('before' => 'csrf', 'uses' => 'MrabrController@unitdetail'));  
    
    Route::resource('mrabr', 'MrabrController'); 
}); 