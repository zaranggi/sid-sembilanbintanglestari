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
    Route::get('appmrabp/approve/{id}', array('uses' => 'AppmrabpController@approve')); 
    Route::get('appmrabp/reject/{id}', array('uses' => 'AppmrabpController@reject')); 
    Route::get('appmrabp/view/{id}', array('uses' => 'AppmrabpController@view'));  	
    Route::resource('appmrabp', 'AppmrabpController');
    

});
