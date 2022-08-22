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
    Route::get('bookingm/listunit/{id}', array('uses' => 'BookingmController@listunit')); 
    Route::post('bookingm/unitdetail', array('before' => 'csrf', 'uses' => 'BookingmController@unitdetail')); 
    Route::post('bookingm/isikan', array('uses' => 'BookingmController@isikan')); 
    Route::post('bookingm/autocomplete', array('uses' => 'BookingmController@autocomplete')); 
    Route::post('bookingm/batal', array('uses' => 'BookingmController@batal')); 
    Route::post('bookingm/fu', array('before' => 'csrf','uses' => 'BookingmController@fu')); 
    Route::resource('bookingm', 'BookingmController');

});
  