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
	
    Route::get('pomaterial/listprodmast/{id}', array('uses' => 'PomaterialController@listprodmast')); 
    Route::get('pomaterial/detail/{id}', array('uses' => 'PomaterialController@detail'));  
    Route::post('pomaterial/simpan', array('before' => 'csrf', 'uses' => 'PomaterialController@simpan'));  
    Route::resource('pomaterial', 'PomaterialController');

});

 