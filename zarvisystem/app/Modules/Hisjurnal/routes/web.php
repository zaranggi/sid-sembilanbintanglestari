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
    
    Route::post('hisjurnal/preview', array('before' => 'csrf', 'uses' => 'HisjurnalController@preview'));  
    Route::post('hisjurnal/datanya', array('before' => 'csrf', 'uses' => 'HisjurnalController@datanya'));  
    Route::resource('hisjurnal', 'HisjurnalController');

});  