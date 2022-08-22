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
    
    Route::get('spkproyek/ajukan/{idspk}', array('before' => 'csrf', 'uses' => 'SpkproyekController@ajukan')); 
    Route::get('spkproyek/detail/{idspk}', array('before' => 'csrf', 'uses' => 'SpkproyekController@detail')); 
    Route::get('spkproyek/setjob/{idspk}', array('before' => 'csrf', 'uses' => 'SpkproyekController@setjob')); 
    Route::post('spkproyek/isikan', array('before' => 'csrf', 'uses' => 'SpkproyekController@isikan')); 
    Route::get('spkproyek/nilaispk', array('uses' => 'SpkproyekController@nilaispk')); 
    Route::post('spkproyek/setjob/simpan', array('before' => 'csrf', 'uses' => 'SpkproyekController@simpan')); 
    Route::post('spkproyek/autocomplete', array('before' => 'csrf', 'uses' => 'SpkproyekController@autocomplete')); 
    Route::resource('spkproyek', 'SpkproyekController');

});
 