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
    
    Route::get('spkrevisi/ajukan/{idspk}', array('before' => 'csrf', 'uses' => 'SpkrevisiController@ajukan')); 
    Route::get('spkrevisi/detail/{idspk}', array('before' => 'csrf', 'uses' => 'SpkrevisiController@detail')); 
    Route::get('spkrevisi/setjob/{idspk}', array('before' => 'csrf', 'uses' => 'SpkrevisiController@setjob')); 
    Route::post('spkrevisi/isikan', array('before' => 'csrf', 'uses' => 'SpkrevisiController@isikan')); 
    Route::get('spkrevisi/nilaispk', array('uses' => 'SpkrevisiController@nilaispk')); 
    Route::post('spkrevisi/setjob/simpan', array('before' => 'csrf', 'uses' => 'SpkrevisiController@simpan')); 
    Route::post('spkrevisi/autocomplete', array('before' => 'csrf', 'uses' => 'SpkrevisiController@autocomplete')); 
    Route::resource('spkrevisi', 'SpkrevisiController');

});
  