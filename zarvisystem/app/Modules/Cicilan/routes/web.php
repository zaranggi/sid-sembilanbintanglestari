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

    Route::post('cicilan/tagihan', array('before' => 'csrf', 'uses' => 'CicilanController@tagihan')); 
    Route::get('cicilan/detail/{id}', array('uses' => 'CicilanController@detail')); 
    Route::get('cicilan/cetak/{kode}', array('uses' => 'CicilanController@cetak')); 
    Route::post('cicilan/simpanbayar', array('before' => 'csrf', 'uses' => 'CicilanController@simpanbayar')); 
    Route::get('cicilan/listall/{id}', array('uses' => 'CicilanController@listall')); 
    Route::resource('cicilan', 'CicilanController');

});
 