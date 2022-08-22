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
    Route::get('trxkonsumen/preview/{id}', array('uses' => 'TrxkonsumenController@preview')); 
    Route::get('trxkonsumen/tambah', array('uses' => 'TrxkonsumenController@tambah')); 
    Route::get('trxkonsumen/listunit/{id}', array('uses' => 'TrxkonsumenController@listunit')); 
    Route::post('trxkonsumen/unitdetail', array('before' => 'csrf', 'uses' => 'TrxkonsumenController@unitdetail')); 
    Route::post('trxkonsumen/isikan', array('before' => 'csrf', 'uses' => 'TrxkonsumenController@isikan')); 
    Route::resource('trxkonsumen', 'TrxkonsumenController');


});
 