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
    Route::get('appbonus/approve/{id}', array('uses' => 'AppbonusController@approve')); 
    Route::get('appbonus/reject/{id}', array('uses' => 'AppbonusController@reject')); 
    Route::get('appbonus/detail/{periode}', array('before' => 'csrf', 'uses' => 'AppbonusController@detail')); 
    Route::resource('appbonus', 'AppbonusController');

}); 
 