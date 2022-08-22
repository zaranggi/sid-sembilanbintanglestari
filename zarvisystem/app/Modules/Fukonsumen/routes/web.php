<?php


    Route::post('fukonsumen/isikan', array('uses' => 'FukonsumenController@isikan')); 
    Route::post('fukonsumen/autocomplete', array('uses' => 'FukonsumenController@autocomplete')); 
Route::group([ 'middleware' => ['web','auth'] ], function() {

    Route::post('fukonsumen/fu', array('before' => 'csrf', 'uses' => 'FukonsumenController@fu')); 
    Route::resource('fukonsumen', 'FukonsumenController');

});

