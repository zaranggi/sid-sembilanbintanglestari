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
    Route::get('appmrab/approve/{kode}', array('uses' => 'AppmrabController@approve')); 
    Route::get('appmrab/reject/{kode}', array('uses' => 'AppmrabController@reject')); 
    Route::get('appmrab/view/{properti}/{tipe_unit}/{kode}', array('uses' => 'AppmrabController@view'));  	
    Route::resource('appmrab', 'AppmrabController');
    

});

 