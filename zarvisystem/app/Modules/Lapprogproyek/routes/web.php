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
    Route::post('lapprogproyek/simpan', array('before' => 'csrf', 'uses' => 'LapprogproyekController@simpan')); 
    Route::get('lapprogproyek/data/{id_properti}', array('uses' => 'LapprogproyekController@data')); 
    Route::resource('lapprogproyek', 'LapprogproyekController');

});
  