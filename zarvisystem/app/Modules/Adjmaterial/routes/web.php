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
    //Route::get('pomaterial/ajukan/{id}', array( 'uses' => 'PomaterialController@simpan'));  
	
    Route::get('adjmaterial/listprodmast/{id}', array('uses' => 'AdjmaterialController@listprodmast')); 
    Route::get('adjmaterial/detail/{id}', array('uses' => 'AdjmaterialController@detail'));  
    Route::post('adjmaterial/simpan', array('before' => 'csrf', 'uses' => 'AdjmaterialController@simpan'));  
    Route::resource('adjmaterial', 'AdjmaterialController');

});

 