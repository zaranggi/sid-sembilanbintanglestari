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
    Route::get('rekapunit/listall/{id}', array('uses' => 'RekapunitController@listall')); 
    Route::post('rekapunit/bast', array('before' => 'csrf', 'uses' => 'RekapunitController@bast'));  
    Route::resource('rekapunit', 'RekapunitController');

});
 