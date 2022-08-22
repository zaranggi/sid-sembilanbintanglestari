<?php


Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('paybebaslahan/tagihan', array('before' => 'csrf', 'uses' => 'PaybebaslahanController@tagihan')); 
    Route::get('paybebaslahan/detail/{id}', array('uses' => 'PaybebaslahanController@detail')); 
    Route::get('paybebaslahan/cetak/{kode}', array('uses' => 'PaybebaslahanController@cetak')); 
    Route::post('paybebaslahan/simpanbayar', array('before' => 'csrf', 'uses' => 'PaybebaslahanController@simpanbayar')); 
    Route::get('paybebaslahan/listall/{id}', array('uses' => 'PaybebaslahanController@listall')); 
    Route::resource('paybebaslahan', 'PaybebaslahanController');

});

