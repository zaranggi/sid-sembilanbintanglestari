<?php


Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('um/tagihan', array('before' => 'csrf', 'uses' => 'UmController@tagihan')); 
    Route::get('um/detail/{id}', array('uses' => 'UmController@detail')); 
    Route::get('um/cetak/{kode}', array('uses' => 'UmController@cetak')); 
    Route::post('um/simpanbayar', array('before' => 'csrf', 'uses' => 'UmController@simpanbayar')); 
    Route::get('um/listall/{id}', array('uses' => 'UmController@listall')); 
    Route::resource('um', 'UmController');

});

