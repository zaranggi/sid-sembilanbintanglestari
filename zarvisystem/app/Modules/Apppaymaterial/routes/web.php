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
    Route::get('apppaymaterial/approve/{docno}/{pembayaran}', array('uses' => 'ApppaymaterialController@approve')); 
    Route::get('apppaymaterial/reject/{docno}/{pembayaran}', array('uses' => 'ApppaymaterialController@reject')); 
    Route::get('apppaymaterial/detail/{docno}/{pembayaran}', array('uses' => 'ApppaymaterialController@detail')); 
    Route::resource('apppaymaterial', 'ApppaymaterialController');
    

}); 