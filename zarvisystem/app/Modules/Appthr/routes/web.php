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
    Route::get('appthr/approve/{id}', array('uses' => 'AppthrController@approve')); 
    Route::get('appthr/reject/{id}', array('uses' => 'AppthrController@reject')); 
    Route::get('appthr/detail/{periode}', array('before' => 'csrf', 'uses' => 'AppthrController@detail')); 
    Route::resource('appthr', 'AppthrController');

}); 
 