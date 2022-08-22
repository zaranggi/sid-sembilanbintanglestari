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


    Route::post('lapsales/preview', array('before' => 'csrf', 'uses' => 'LapsalesController@preview'));  
    Route::get('lapsales/ckonsumen/{id}/{tanggal1}/{tanggal2}', array('before' => 'csrf', 'uses' => 'LapsalesController@ckonsumen'));  
    Route::get('lapsales/spr/{id}/{tanggal1}/{tanggal2}', array('before' => 'csrf', 'uses' => 'LapsalesController@spr'));  
    Route::resource('lapsales', 'LapsalesController');


});
 