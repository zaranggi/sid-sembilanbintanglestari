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

    Route::post('ppn/tagihan', array('before' => 'csrf', 'uses' => 'PpnController@tagihan')); 
    Route::get('ppn/detail/{id}', array('uses' => 'PpnController@detail')); 
    Route::post('ppn/simpanbayar', array('before' => 'csrf', 'uses' => 'PpnController@simpanbayar')); 
    Route::get('ppn/listall/{id}', array('uses' => 'PpnController@listall')); 
    Route::resource('ppn', 'PpnController');

}); 
