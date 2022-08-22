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
    Route::get('apppo/approve/{docno}/{pembayaran}', array('uses' => 'ApppoController@approve')); 
    Route::get('apppo/reject/{docno}/{pembayaran}', array('uses' => 'ApppoController@reject')); 
    Route::get('apppo/detail/{docno}/{pembayaran}', array('uses' => 'ApppoController@detail')); 
    Route::resource('apppo', 'ApppoController');
    

}); 