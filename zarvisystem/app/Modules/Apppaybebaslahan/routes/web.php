<?php


Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('apppaybebaslahan/tagihan', array('before' => 'csrf', 'uses' => 'ApppaybebaslahanController@tagihan')); 
    Route::get('apppaybebaslahan/detail/{id}', array('uses' => 'ApppaybebaslahanController@detail')); 
    Route::get('apppaybebaslahan/cetak/{kode}', array('uses' => 'ApppaybebaslahanController@cetak')); 
    Route::post('apppaybebaslahan/simpanbayar', array('before' => 'csrf', 'uses' => 'ApppaybebaslahanController@simpanbayar')); 
    Route::get('apppaybebaslahan/listall/{id}', array('uses' => 'ApppaybebaslahanController@listall')); 
    
    Route::get('apppaybebaslahan/approve/{id}', array('uses' => 'ApppaybebaslahanController@approve')); 
    Route::get('apppaybebaslahan/reject/{id}', array('uses' => 'ApppaybebaslahanController@reject')); 
    Route::resource('apppaybebaslahan', 'ApppaybebaslahanController');

});

