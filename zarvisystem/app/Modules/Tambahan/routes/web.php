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

    Route::post('tambahan/tagihan', array('before' => 'csrf', 'uses' => 'TambahanController@tagihan')); 
    Route::get('tambahan/cetak/{kode}', array('uses' => 'TambahanController@cetak')); 
    Route::get('tambahan/detail/{id}', array('uses' => 'TambahanController@detail')); 
    Route::post('tambahan/simpanbayar', array('before' => 'csrf', 'uses' => 'TambahanController@simpanbayar')); 
    Route::get('tambahan/listall/{id}', array('uses' => 'TambahanController@listall')); 
    Route::resource('tambahan', 'TambahanController');

});
 
  