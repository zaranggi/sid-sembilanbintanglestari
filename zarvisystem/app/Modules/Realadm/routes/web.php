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


    
    Route::get('realadm/listunit/{id}', array('uses' => 'RealadmController@listunit')); 
    Route::post('realadm/unitdetail', array('before' => 'csrf', 'uses' => 'RealadmController@unitdetail')); 
    Route::resource('realadm', 'RealadmController');

}); 
  