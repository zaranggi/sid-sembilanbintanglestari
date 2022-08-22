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
    
    Route::post('apppayrev/simpanbayar', array('before' => 'csrf', 'uses' => 'ApppayrevController@simpanbayar')); 
    Route::get('apppayrev/preview/{id}', array('before' => 'csrf', 'uses' => 'ApppayrevController@preview')); 
    Route::get('apppayrev/detail/{id}', array('before' => 'csrf', 'uses' => 'ApppayrevController@detail')); 
    //Route::get('apppayrev/tambah/{id}', array('uses' => 'ApppayrevController@tambah')); 
    Route::resource('apppayrev', 'ApppayrevController');

});


 