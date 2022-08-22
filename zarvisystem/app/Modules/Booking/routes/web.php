<?php


Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('booking/tagihan', array('before' => 'csrf', 'uses' => 'BookingController@tagihan')); 
    Route::get('booking/cetak/{id}/{urutan}', array('uses' => 'BookingController@cetak')); 
    Route::get('booking/detail/{id}', array('uses' => 'BookingController@detail')); 
    Route::post('booking/simpanbayar', array('before' => 'csrf', 'uses' => 'BookingController@simpanbayar')); 
    Route::get('booking/listall/{id}', array('uses' => 'BookingController@listall')); 
    Route::resource('booking', 'BookingController');

});

