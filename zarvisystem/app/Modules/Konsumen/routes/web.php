<?php



Route::group([ 'middleware' => ['web','auth'] ], function() {

    //Route::post('munit/saveedit', array('before' => 'csrf', 'uses' => 'MunitController@saveedit')); 
    Route::post('konsumen/mykonsumen', array('before' => 'csrf', 'uses' => 'KonsumenController@mykonsumen')); 
    Route::post('konsumen/simpangambar', array('before' => 'csrf', 'uses' => 'KonsumenController@simpangambar')); 
    Route::post('konsumen/autocomplete', array('before' => 'csrf', 'uses' => 'KonsumenController@autocomplete'));
    Route::get('konsumen/data/{id}', array('uses' => 'KonsumenController@datakonsumen')); 
    Route::resource('konsumen', 'KonsumenController');

});


