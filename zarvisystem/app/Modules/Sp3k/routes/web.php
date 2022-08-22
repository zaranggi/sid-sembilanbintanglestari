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


    Route::post('sp3k/isikan', array('before' => 'csrf', 'uses' => 'Sp3kController@isikan')); 
    Route::post('sp3k/autocomplete', array('before' => 'csrf', 'uses' => 'Sp3kController@autocomplete')); 
    Route::resource('sp3k', 'Sp3kController');

}); 