<?php
 
Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('kprk/tagihan', array('before' => 'csrf', 'uses' => 'KprkController@tagihan')); 
    Route::get('kprk/detail/{id}', array('uses' => 'KprkController@detail')); 
    Route::post('kprk/simpanbayar', array('before' => 'csrf', 'uses' => 'KprkController@simpanbayar')); 
    Route::get('kprk/listall/{id}', array('uses' => 'KprkController@listall')); 
    Route::resource('kprk', 'KprkController');

});

