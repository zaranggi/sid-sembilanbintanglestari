<?php


Route::group([ 'middleware' => ['web','auth'] ], function() {

    //Route::post('munit/saveedit', array('before' => 'csrf', 'uses' => 'MunitController@saveedit')); 
    Route::post('ckonsumen/saveadd', array('before' => 'csrf', 'uses' => 'CkonsumenController@saveadd')); 
    Route::post('ckonsumen/simpangambar', array('before' => 'csrf', 'uses' => 'CkonsumenController@simpangambar')); 
    Route::get('ckonsumen/tambah/{id}', array('uses' => 'CkonsumenController@tambah')); 
    Route::get('ckonsumen/data/{id}', array('uses' => 'CkonsumenController@datakonsumen')); 
    Route::resource('ckonsumen', 'CkonsumenController');

});

