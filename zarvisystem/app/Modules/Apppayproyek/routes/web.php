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
    
    Route::post('apppayproyek/simpanbayar', array('before' => 'csrf', 'uses' => 'ApppayproyekController@simpanbayar')); 
    Route::get('apppayproyek/preview/{id}', array('before' => 'csrf', 'uses' => 'ApppayproyekController@preview')); 
    Route::get('apppayproyek/detail/{id}', array('before' => 'csrf', 'uses' => 'ApppayproyekController@detail')); 
    //Route::get('apppayproyek/tambah/{id}', array('uses' => 'ApppayproyekController@tambah')); 
    Route::resource('apppayproyek', 'ApppayproyekController');

});


 