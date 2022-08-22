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
    Route::post('bookingkeu/note', array('uses' => 'BookingkeuController@note'));
    Route::post('bookingkeu/fu', array('before' => 'csrf','uses' => 'BookingkeuController@fu'));
    Route::resource('bookingkeu', 'BookingkeuController');

});
