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


    
    Route::get('realisasi/listunit/{id}', array('uses' => 'RealisasiController@listunit')); 
    Route::post('realisasi/unitdetail', array('before' => 'csrf', 'uses' => 'RealisasiController@unitdetail')); 
    Route::resource('realisasi', 'RealisasiController');

}); 
 