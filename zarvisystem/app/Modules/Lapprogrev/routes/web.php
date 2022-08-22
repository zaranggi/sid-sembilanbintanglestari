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
    Route::post('lapprogrev/simpan', array('before' => 'csrf', 'uses' => 'LapprogrevController@simpan')); 
    Route::get('lapprogrev/data/{id_properti}', array('uses' => 'LapprogrevController@data')); 
    Route::resource('lapprogrev', 'LapprogrevController');

});
   