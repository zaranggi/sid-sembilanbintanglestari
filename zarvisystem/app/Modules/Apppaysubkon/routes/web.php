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

    //Route::post('munit/saveedit', array('before' => 'csrf', 'uses' => 'MunitController@saveedit')); 
    
    Route::post('apppaysubkon/simpanbayar', array('before' => 'csrf', 'uses' => 'ApppaysubkonController@simpanbayar')); 
    Route::get('apppaysubkon/preview/{id}', array('before' => 'csrf', 'uses' => 'ApppaysubkonController@preview')); 
    Route::get('apppaysubkon/detail/{id}', array('before' => 'csrf', 'uses' => 'ApppaysubkonController@detail')); 
    //Route::get('apppaysubkon/tambah/{id}', array('uses' => 'ApppaysubkonController@tambah')); 
    Route::resource('apppaysubkon', 'ApppaysubkonController');

});


 