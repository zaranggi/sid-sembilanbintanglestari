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

    
    Route::get('spk/ajukan/{idspk}', array('before' => 'csrf', 'uses' => 'SpkController@ajukan')); 
    Route::get('spk/detail/{idspk}', array('before' => 'csrf', 'uses' => 'SpkController@detail')); 
    Route::get('spk/setjob/{idspk}', array('before' => 'csrf', 'uses' => 'SpkController@setjob')); 
    Route::post('spk/isikan', array('before' => 'csrf', 'uses' => 'SpkController@isikan')); 
    Route::get('spk/nilaispk', array('uses' => 'SpkController@nilaispk')); 
    Route::post('spk/setjob/simpan', array('before' => 'csrf', 'uses' => 'SpkController@simpan')); 
    Route::post('spk/autocomplete', array('before' => 'csrf', 'uses' => 'SpkController@autocomplete')); 
    Route::resource('spk', 'SpkController');
    
    Route::get('spk/listunit/{id}', array('uses' => 'SpkController@listunit')); 
    Route::get('spk/listspknya/{query1}/{query2}', array('uses' => 'SpkController@listspknya')); 
    Route::post('spk/unitdetail', array('before' => 'csrf', 'uses' => 'SpkController@unitdetail')); 
    


});
  