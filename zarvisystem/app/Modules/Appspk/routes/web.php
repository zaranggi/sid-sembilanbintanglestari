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
    Route::get('appspk/approve/{id}', array('uses' => 'AppspkController@approve')); 
    Route::get('appspk/reject/{id}', array('uses' => 'AppspkController@reject')); 
    Route::get('appspk/detail/{id}', array('uses' => 'AppspkController@detail')); 
    Route::resource('appspk', 'AppspkController');
    

});
 