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
    Route::get('appmrabnew/approve/{id}', array('uses' => 'AppmrabnewController@approve'));
    Route::get('appmrabnew/reject/{id}', array('uses' => 'AppmrabnewController@reject'));
    Route::get('appmrabnew/view/{id}', array('uses' => 'AppmrabnewController@view'));
    Route::resource('appmrabnew', 'AppmrabnewController');


});
